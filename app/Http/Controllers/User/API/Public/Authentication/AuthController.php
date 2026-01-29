<?php

namespace App\Http\Controllers\User\API\Public\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Public\Auth\ForgetPasswordRequest;
use App\Http\Requests\User\API\Public\Auth\LoginRequest;
use App\Http\Requests\User\API\Public\Auth\ResetPasswordRequest;
use App\Http\Requests\User\API\Public\Auth\VerifyingLoginOTPRequest;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Models\User__AccountStatusHistory;
use App\Models\User_OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        //check user is exist
        $user = User::where([
            ['phone_number',$request->phone_number],
            ['account_type',"customer"]
        ])->first();
        if($user)
        {
            //check activation account
            if($user->activation_status == "active")
            {
                if($user->account_status == "approved")
                {
                    //add in user__OTPs
                    $user_otp = new User_OTP();
                    $user_otp->user_id = $user->id;
                    $user_otp->otp = rand(100000, 999999);
                    $user_otp->type = "customer_login";
                    $user_otp->expired_at = Carbon::now()->addMinutes(20);
                    $user_otp->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'this user already exist and we will send OTP',
                        'otp' => $user_otp->otp,
                        'activation_status' => $user->activation_status,
                        'account_status' => $user->account_status
                    ]);
                }
                else
                {
                    return response()->json([
                        'success' => true,
                        'message' => 'this user already exist but there is problem in his account',
                        'activation_status' => $user->activation_status,
                        'account_status' => $user->account_status
                    ]);
                }
            }
            elseif($user->activation_status == "inactive")
            {
                return response()->json([
                    'success' => true,
                    'message' => 'this user already exist but not send OTP Yet',
                    'activation_status' => $user->activation_status,
                    'account_status' => $user->account_status
                ]);
            }
        }
        else
        {
            //create new user
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->country_dial_code_id = $request->country_dial_code_id;
            $new_user->phone_number = $request->phone_number;
            $new_user->account_type = "customer";
            $new_user->activation_status = "inactive";
            $new_user->account_status= "approved";
            $new_user->save();

            //add in user___account_status_histories table
            $new_status_history = new User__AccountStatusHistory();
            $new_status_history->created_by_id = $new_user->id;
            $new_status_history->user_id = $new_user->id;
            $new_status_history->account_status = $new_user->account_status;
            $new_status_history->save();

            //add in user__OTPs
            $new_user_otp = new User_OTP();
            $new_user_otp->user_id = $new_user->id;
            $new_user_otp->otp = rand(100000, 999999);
            $new_user_otp->type = "customer_register";
            $new_user_otp->expired_at = Carbon::now()->addMinutes(20);
            $new_user_otp->save();
            ////---------------------------
            ///Send OTP To mail
            ////--------------------------
            return response()->json([
                'success' => true,
                'message' => 'register customer successfully, OTP sent to mobile',
                'otp' => $new_user_otp->otp
            ]);
        }
    }

    public function verifyOtpLogin(VerifyingLoginOTPRequest $request)
    {
        $user = User::where([
            ['phone_number',$request->phone_number],
            ['account_type' ,'customer']
        ])->first();
        if(!$user)
        {
            return response()->json([
                'success' => false,
                'message' => 'This User Not found'
            ], 404);
        }
        else
        {
            $user_otp = $user->user_OTPs()->where([
                ['otp',$request->otp],
                ['expired_at','>',now()],
                ['status','active']
            ])
            ->where('type',"customer_login")
            ->orWhere('type',"customer_register")
            ->latest()->first();
            if(!$user_otp)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP',
                ], 400);
            }
            else
            {
                $user->verified_at = now();
                $user->activation_status = "active";
                $user->account_status = "approved";
                $user->save();

                //add in user___account_status_histories table
                $new_status_history = new User__AccountStatusHistory();
                $new_status_history->created_by_id = $user->id;
                $new_status_history->user_id = $user->id;
                $new_status_history->account_status = $user->account_status;
                $new_status_history->save();

                //check user is customer
                $check_user = Customer::where('user_id',$user->id)->first();
                if(!$check_user)
                {
                    //add in customers
                    $new_customer= new Customer();
                    $new_customer->user_id = $user->id;
                    $new_customer->save();
                    //assign role to user
                    $customer_role = Role::where([
                        ['name','customer'],
                        ['guard_name', 'api']
                    ])->first();
                    $user->assignRole($customer_role);
                }


                $user_otp->otp = null;
                $user_otp->status = "inactive";
                $user_otp->save();
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'data'=> new UserResource($user)
                ], 200);
            }
        }
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $user= User::where('phone_number',$request->phone_number)->first();

        if(!$user)
        {
            return response()->json([
                'success' => false,
                'message' => 'This User Not found'
            ], 404);
        }
        else
        {
            if($user->account_status == "active")
            {
                //add in user__OTPs
                $new_user_otp = new User_OTP();
                $new_user_otp->user_id = $user->id;
                $new_user_otp->otp = rand(100000, 999999);
                $new_user_otp->type = "reset_password";
                $new_user_otp->expired_at = Carbon::now()->addMinutes(20);
                $new_user_otp->save();
                ////---------------------------
                ///Send OTP To mail
                ////--------------------------
                return response()->json([
                    'success' => true,
                    'data' =>[
                        'OTP' => $new_user_otp->otp
                    ],
                    'message' => 'If the phone number exists, an OTP has been sent'
                ], 200);
            }
            else
            {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'account_status' => $user->account_status,
                    ],
                    'message' => 'this account is'.$user->account_status,
                ], 200);
            }
        }
    }

    public function verifyOtpForgetPassword(VerifyingOTPRequest $request)
    {
        $user = User::where([
            ['phone_number',$request->phone_number],
        ])->first();
        if(!$user)
        {
            return response()->json([
                'success' => false,
                'message' => 'This User Not found'
            ], 404);
        }
        else
        {
            $user_otp = $user->user_OTPs()->where([
                ['otp',$request->otp],
                ['type',"reset_password"],
                ['expired_at','>',now()],
                ['status','active']
            ])->latest()->first();
            if(!$user_otp)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP',
                ], 400);
            }
            else
            {
                $user->verified_at = now();
                $user->save();
                $user_otp->otp = null;
                $user_otp->status = "inactive";
                $user_otp->save();
                $resetToken = Str::random(60);
                $new_password_reset_token = new PasswordResetToken();
                $new_password_reset_token->phone_number = $user->phone_number;
                $new_password_reset_token->token = $resetToken;
                $new_password_reset_token->created_at = now();
                $new_password_reset_token->save();
                // $token = $user->createToken('api-token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'temporary_token' => $resetToken
                ], 200);
            }
        }
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        //check if this in password_reset_tokens
        $check_in_password_reset_tokens = PasswordResetToken::where('phone_number',$request->phone_number)
                                                            ->where('token',$request->token)
                                                            ->first();
        if(!$check_in_password_reset_tokens)
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token or Phone number'
            ], 400);
        }
        else
        {
            //get user
            $user = User::where('phone_number',$request->phone_number)->first();
            if (!$user)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $user->password = Hash::make($request->password);
            $user->save();
            //delete in password_reset_tokens table
            PasswordResetToken::where('phone_number', $request->phone_number)->delete();

            $credentials = [
                'phone_number' => $request->phone_number,
                'password' => $request->password
            ];

            if(Auth::attempt($credentials))
            {
                $user = Auth::user();
                $user->tokens()->delete();
                $token = $user->createToken('api-token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' =>"Password reset successfully",
                    'token' => $token,
                    'data'=> new UserResource($user)
                ], 200);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
