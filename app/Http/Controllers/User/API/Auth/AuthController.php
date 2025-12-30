<?php

namespace App\Http\Controllers\User\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Auth\RegisterRequest;
use App\Http\Requests\User\API\Auth\VerifyingOTPRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\User_OTP;
use App\Models\VendorRepresentative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/en/user/auth/register",
     *     summary="Register new user and send OTP",
     *     description="Register user using name, phone number, country dial code and account type, then send OTP",
     *     operationId="registerUser",
     *     tags={"Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             oneOf={
     *                 @OA\Schema(
     *                     title="CustomerRegister",
     *                     required={"name","country_dial_code_id","phone_number","account_type"},
     *                     @OA\Property(property="name", type="string", example="Menna"),
     *                     @OA\Property(property="country_dial_code_id", type="integer", example=20),
     *                     @OA\Property(property="phone_number", type="string", example="01012345678"),
     *                     @OA\Property(
     *                         property="account_type",
     *                         type="string",
     *                         enum={"customer"},
     *                         example="customer"
     *                     )
     *                 ),
     *
     *                 @OA\Schema(
     *                     title="VendorRepresentativeRegister",
     *                     required={"name","country_dial_code_id","phone_number","account_type","email","password","position"},
     *                     @OA\Property(property="name", type="string", example="Menna"),
     *                     @OA\Property(property="country_dial_code_id", type="integer", example=20),
     *                     @OA\Property(property="phone_number", type="string", example="01012345678"),
     *                     @OA\Property(
     *                         property="account_type",
     *                         type="string",
     *                         enum={"vendor_representative"},
     *                         example="vendor_representative"
     *                     ),
     *                     @OA\Property(property="email", type="string", example="vendor@test.com"),
     *                     @OA\Property(property="password", type="string", example="123456"),
     *                     @OA\Property(property="position", type="string", example="Sales Manager")
     *                 )
     *
     *             }
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Registered successfully, OTP sent to mobile")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function register(RegisterRequest $request)
    {
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->country_dial_code_id = $request->country_dial_code_id;
        $new_user->phone_number = $request->phone_number;
        $new_user->account_type = $request->account_type;
        $new_user->save();
        if($request->account_type == "vendor_representative")
        {
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->save();
            //add in "vendor_representatives" table
            $new_vendor_representative = new VendorRepresentative();
            $new_vendor_representative->created_by_id = $new_user->id;
            $new_vendor_representative->user_id = $new_user->id;
            $new_vendor_representative->position = $request->position;
            $new_vendor_representative->save();

            //assign role to user
            $vendor_representative_role = Role::where([
                ['name','vendor_representative'],
                ['guard_name', 'api']
            ])->first();
            $new_user->assignRole($vendor_representative_role);
        }
        elseif($request->account_type == "customer")
        {
            $customer_role = Role::where([
                ['name','customer'],
                ['guard_name', 'api']
            ])->first();
            $new_user->assignRole($customer_role);
        }
        $new_user_otp = new User_OTP();
        $new_user_otp->user_id = $new_user->id;
        $new_user_otp->otp = rand(100000, 999999);
        $new_user_otp->type = "register";
        $new_user_otp->expired_at = Carbon::now()->addMinutes(20);
        $new_user_otp->save();
        ////---------------------------
        ///Send OTP To mail
        ////--------------------------
        return response()->json([
            'success' => true,
            'message' => 'Registered successfully, OTP sent to mobile'
        ]);
    }


    /**
     * @OA\Post(
     *     path="/api/en/user/auth/verify-otp-register",
     *     summary="Verifying OTP",
     *     description="Register user using  phone number, country dial code and OTP to verify his account",
     *     operationId="verify-otp-register",
     *     tags={"Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"country_dial_code_id","phone_number","otp"},
     *             @OA\Property(property="country_dial_code_id", type="integer", example=242, description="Country dial code ID"),
     *             @OA\Property(property="phone_number", type="string", example="01012345678", description="User mobile number"),
     *             @OA\Property(property="otp", type="string", example="123456", description="OTP sent to mobile")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="verification successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "success": true,
     *                 "token" :"3|QrRpUFZQO5KsBr0G1uONl3EftznaappuMcnuOlg79950949e",
     *                 "data": {
     *                      "user_id": 7,
     *                      "user_name": "Menna",
     *                      "user_slug": "menna",
     *                      "user_email": "menna1@test.com",
     *                      "user_country_dial_code_id": 242,
     *                      "user_phone_number": "01096856825",
     *                      "user_account_type": "vendor_representative",
     *                      "vendor_representative": {
     *                          "vendor_rep_id": 5,
     *                          "vendor_rep_position": "manager"
     *                      }
     *                 },
     *             },
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Registered successfully, OTP sent to mobile")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="user not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid or expired OTP"
     *     )
     * )
     */

    public function verifyOtpRegister(VerifyingOTPRequest $request)
    {
        $user = User::where([
            ['country_dial_code_id',$request->country_dial_code_id],
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
                $user->save();
                $user_otp->otp = null;
                $user_otp->expired_at = null;
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
    /**
     * @OA\Post(
     *     path="http://127.0.0.1:8000/api/en/user/logout",
     *     summary="Logout User",
     *     description="Logout User From All Devices",
     *     operationId="logout",
     *     tags={"Authentication"},
     *
     *     security={{"sanctum": {}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Logged out successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Logged out successfully")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized - invalid or missing token",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }

}
