<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\API\Vendor\Branch\CreateRequest;
use App\Models\VendorBranch__OperatingHour;
use App\Models\VendorBranch__OperatingHourShift;
use App\Models\VendorBranche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/branch/create",
 *     tags={"Vendor Endpoints"},
 *     summary="---Create Branch Endpoint---",
 *     description="Create New Branch",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="name",
 *                 type="object",
 *                 @OA\Property(property="en", type="string", example="branch1"),
 *                 @OA\Property(property="ar", type="string", example="branch1")
 *             ),
 *             @OA\Property(property="city_id", type="integer", example="1"),
 *             @OA\Property(property="district_name", type="string", example="district1"),
 *             @OA\Property(property="google_place_link", type="string", example="https://maps.app.goo.gl/HXVbNNgQfSUFZkvK7"),
 *             @OA\Property(property="phone_number", type="string", example="0501234567"),
 *             @OA\Property(property="whatsapp_number", type="string", example="0501234567"),
 *             @OA\Property(property="number_of_tables", type="integer", example="5"),
 *             @OA\Property(property="activation_status", type="active", example="district1"),
 *             @OA\Property(
 *                 property="operating_hours",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="day_of_week", type="integer", example="1"),
 *                     @OA\Property(
 *                         property="shifts",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="opening_time", type="string", example="09:00:00"),
 *                             @OA\Property(property="closing_time", type="string", example="09:00:00"),
 *                             @OA\Property(property="is_open", type="string", example="yes"),
 *                         )
 *                     )
 *                )
 *             ),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Get vendor data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="success Login"),
 *             @OA\Property(property="token", type="string", example="38|hmKx2mys6d2wKJw75x4qR3AVvoIuF69RwHMhk8EF7ab40fbb"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="user_id", type="integer", example=1),
 *                 @OA\Property(property="user_name", type="string", example="Menna"),
 *                 @OA\Property(property="user_slug", type="string", example="menna"),
 *                 @OA\Property(property="user_email", type="string", example="menna_vendor_rep@test.com"),
 *                 @OA\Property(property="user_country_dial_code_id", type="integer", example="242"),
 *                 @OA\Property(property="user_phone_number", type="string", example="0501234567"),
 *                 @OA\Property(property="user_account_type", type="string", example="vendor_representative"),
 *                 @OA\Property(
 *                      property="vendor_representative",
 *                      type="object",
 *                      @OA\Property(property="vendor_rep_id", type="integer", example=1),
 *                      @OA\Property(property="vendor_rep_position", type="string", example="manager"),
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */
    public function create(CreateRequest $request)
    {
        $user = Auth::user();
        //add in vendor___branches table
        $new_vendor_branch = new VendorBranche();
        $new_vendor_branch->created_by_id = $user->id;
        $new_vendor_branch->vendor_id = $user->vendor_representative->vendor->id;
        $new_vendor_branch->city_id = $request->city_id;
        $new_vendor_branch->name = $request->name;
        $new_vendor_branch->district_name = $request->district_name;
        $new_vendor_branch->phone_number = $request->phone_number;
        $new_vendor_branch->whatsapp_number = $request->whatsapp_number;
        $new_vendor_branch->google_place_link = $request->google_place_link;
        $new_vendor_branch->number_of_tables =$request->number_of_tables;
        $new_vendor_branch->activation_status = $request->activation_status;
        $new_vendor_branch->save();
        $operating_hours = $request->operating_hours;
        foreach($request->operating_hours as $one_day)
        {
            $new_branch_operation_houre = new VendorBranch__OperatingHour();
            $new_branch_operation_houre->created_by_id = $user->id;
            $new_branch_operation_houre->branch_id = $new_vendor_branch->id;
            $new_branch_operation_houre->day_of_week = $one_day['day_of_week'];
            $new_branch_operation_houre->save();

            foreach($one_day['shifts'] as $one_shift)
            {
                $new_shift = new VendorBranch__OperatingHourShift();
                $new_shift->created_by_id = $user->id;
                $new_shift->operating_hours_id = $new_branch_operation_houre->id;
                $new_shift->opening_time = $one_shift['opening_time'];
                $new_shift->closing_time = $one_shift['closing_time'];
                $new_shift->is_open = $one_shift['is_open'];
                $new_shift->save();
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Branch Add successfuly'
        ]);

    }
}
