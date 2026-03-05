<?php

namespace App\Http\Controllers\User\API\Vendor\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Auth\ForgetPasswordRequest;
use App\Http\Requests\User\API\Vendor\Auth\LoginRequest;
use App\Http\Requests\User\API\Vendor\Auth\RegisterRequest;
use App\Http\Requests\User\API\Vendor\Auth\ResetPasswordRequest;
use App\Http\Requests\User\API\Vendor\Auth\VerifyingOTPRequest;
use App\Http\Resources\UserResource;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Models\User__AccountStatusHistory;
use App\Models\User_OTP;
use App\Models\Vendor;
use App\Models\Vendor__MenuTheme;
use App\Models\Vendor__MenuThemeDetail;
use App\Models\Vendor__PackegeSubscription;
use App\Models\Vendor_VendorType;
use App\Models\VendorRepresentative;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->country_dial_code_id = $request->country_dial_code_id;
        $new_user->phone_number = $request->phone_number;
        $new_user->account_type = "vendor_representative";
        $new_user->activation_status = "inactive";
        $new_user->account_status = "pending_review";
        $new_user->save();

        $new_user_account_history = new User__AccountStatusHistory();
        $new_user_account_history->created_by_id = $new_user->id;
        $new_user_account_history->user_id= $new_user->id;
        $new_user_account_history->account_status = $new_user->account_status;
        $new_user_account_history->save();

        //add in vendors
        $new_vendor= new Vendor();
        $new_vendor->created_by_id = $new_user->id;
        $new_vendor->company_name = $request->company_name;
        $new_vendor->save();

        //add in vendor___vendor_types table
        $new_vendor_vendor_type = new Vendor_VendorType();
        $new_vendor_vendor_type->type_id = $request->vendor_type_id;
        $new_vendor_vendor_type->vendor_id = $new_vendor->id;
        $new_vendor_vendor_type->save();

        //add in "vendor_representatives" table
        $new_vendor_representative = new VendorRepresentative();
        $new_vendor_representative->created_by_id = $new_user->id;
        $new_vendor_representative->user_id = $new_user->id;
        $new_vendor_representative->vendor_id = $new_vendor->id;
        $new_vendor_representative->position = $request->position;
        $new_vendor_representative->save();

        //add in vendor___package_subscriptions table
        $new_vendor_package_subscription = new Vendor__PackegeSubscription();
        $new_vendor_package_subscription->created_by_id = $new_user->id;
        $new_vendor_package_subscription->vendor_id = $new_vendor->id;
        $new_vendor_package_subscription->package_id = 1;
        $new_vendor_package_subscription->start_at = now();
        $new_vendor_package_subscription->end_at = now()->addYear();
        $new_vendor_package_subscription->end_trial_at = now()->addDays(30);
        $new_vendor_package_subscription->status = 'active';
        $new_vendor_package_subscription->price_at_purchase = 0;
        $new_vendor_package_subscription->paid_amount = 0;
        $new_vendor_package_subscription->save();

        //add in vendor___menu_themes table
        $new_vendor_menu_theme = new Vendor__MenuTheme();
        $new_vendor_menu_theme->created_by_id = $new_user->id;
        $new_vendor_menu_theme->vendor_id = $new_vendor->id;
        $new_vendor_menu_theme->save();

        //add in vendor___menu_theme_details table
        $new_menu_theme_details = new Vendor__MenuThemeDetail();
        $new_menu_theme_details->menu_theme_id = $new_vendor_menu_theme->id;
        $new_menu_theme_details->background_color = "#FFFFFF";
        $new_menu_theme_details->borders_and_dividers_color = "#D9D9D9";
        $new_menu_theme_details->main_text_color = "#272727";
        $new_menu_theme_details->secondary_text_color = "#5C5C5C";
        $new_menu_theme_details->lang_btn_color = "#272727";
        $new_menu_theme_details->lang_btn_background_color = "#FFFFFF";
        $new_menu_theme_details->review_and_working_hours_text_color = "#272727";
        $new_menu_theme_details->card_background_color = "#FFFFFF";
        $new_menu_theme_details->card_title_color = "#272727";
        $new_menu_theme_details->social_media_color = "#626262";
        $new_menu_theme_details->main_category_specified_color = "#603081";
        $new_menu_theme_details->main_category_not_specified_color = "#603081";
        $new_menu_theme_details->sub_category_specified_color = "#D9D9D9";
        $new_menu_theme_details->sub_category_not_specified_color = "#272727";
        $new_menu_theme_details->category_title_color = "#272727";
        $new_menu_theme_details->product_title_color = "#272727";
        $new_menu_theme_details->product_description_color = "#5C5C5C";
        $new_menu_theme_details->product_data_color = "#5C5C5C";
        $new_menu_theme_details->product_image_border_color = "#D9D9D9";
        $new_menu_theme_details->product_price_color = "#272727";
        $new_menu_theme_details->product_price_before_discount_color = "#5C5C5C";
        $new_menu_theme_details->offer_background_color = "#FEF085";
        $new_menu_theme_details->offer_text_color = "#272727";
        $new_menu_theme_details->call_waiter_btn_color = "#FFFFFF";
        $new_menu_theme_details->call_waiter_btn_background_color = "#603081";
        $new_menu_theme_details->favourite_btn_color = "#D9D9D9";
        $new_menu_theme_details->favourite_icon_color = "#626262";
        $new_menu_theme_details->review_btn_text_color = "#393939";
        $new_menu_theme_details->review_btn_background_color = "#EDEDED";
        $new_menu_theme_details->back_btn_color = "#111827";
        $new_menu_theme_details->back_btn_background_color = "#F5F5F5";
        $new_menu_theme_details->close_btn_color = "#603081";
        $new_menu_theme_details->close_btn_background_color = "#FFFFFF";
        $new_menu_theme_details->input_filed_background_color = "#FFFFFF";
        $new_menu_theme_details->input_filed_text_color = "#5C5C5C";
        $new_menu_theme_details->additional_information_color = "#626262";
        $new_menu_theme_details->primary_color = "#626262";
        $new_menu_theme_details->font_family = "Changa";
        $new_menu_theme_details->save();

        //assign role to user
        $vendor_representative_role = Role::where([
            ['name','vendor_representative'],
            ['guard_name', 'api']
        ])->first();
        $new_user->assignRole($vendor_representative_role);

        //add in user__OTPs
        $new_user_otp = new User_OTP();
        $new_user_otp->user_id = $new_user->id;
        $new_user_otp->otp = rand(1000, 9999);
        $new_user_otp->type = "register";
        $new_user_otp->expired_at = Carbon::now()->addMinutes(20);
        $new_user_otp->save();
        ////---------------------------
        ///Send OTP To mail
        ////--------------------------
        return response()->json([
            'success' => true,
            'message' => 'Registered successfully, OTP sent to mobile',
            'otp' => $new_user_otp->otp
        ]);
    }

    public function verifyOtpRegister(VerifyingOTPRequest $request)
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
                ['type',"register"],
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
                $user->activation_status = "active";
                $user->save();
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

    public function login(LoginRequest $request)
    {
        //check password is null exist
        $user = User::where([
            ['phone_number',$request->phone_number],
        ])->first();
        if($user->account_type == "customer" || $user->account_type == "shams_employee" || $user->account_type == "guest")
        {
            return response()->json([
                'success' =>'false',
                'message' => 'Access denied.'
            ], 403);
        }
        if($user && !$user->password)
        {
            $user->password = Hash::make($request->password);
            $user->activation_status = "active";
            $user->account_status = "approved";
            $user->save();
        }
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
                'message' =>"success Login",
                'token' => $token,
                'data'=> new UserResource($user)
            ], 200);
        }
        else
        {
            return response()->json(['message' => 'Invalid credentials'], 401);
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
            if($user->activation_status == "active")
            {
                //add in user__OTPs
                $new_user_otp = new User_OTP();
                $new_user_otp->user_id = $user->id;
                $new_user_otp->otp = rand(1000, 9999);
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
                        'activation_status' => $user->activation_status,
                        'account_status ' => $user->account_status,
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
