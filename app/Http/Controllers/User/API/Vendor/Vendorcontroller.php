<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\Request;

class Vendorcontroller extends Controller
{
/**
 * @OA\Get(
 *     path="/api/{locale}/user/vendor/{slug}/",
 *     tags={"Vendor_API", "Vendor_API.vendor"},
 *     summary="Get Vendor Data",
 *     description="Get Vendor Data",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="slug",
 *         in="path",
 *         required=true,
 *         description="the slug of vendor",
 *         @OA\Schema(type="string", example="shams")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Get vendor data successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Get vendor Data Successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="brand_name", type="string", example="Apple"),
 *                 @OA\Property(property="logo", type="string", example="logo.png"),
 *                 @OA\Property(property="banar", type="string", example="banar.png"),
 *                 @OA\Property(property="slogan", type="string", example="Think Different")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Vendor not found"
 *     )
 * )
 */

    public function vendor_data($locale,$slug)
    {
        $vendor = Vendor::where('slug',$slug)->first();
        if(!$vendor)
        {
            return response()->json([
                'status'=>'error',
                'message' =>'vendor not found',
            ],404);
        }
        return response()->json([
            'status'=>'success',
            'message' =>'Get vendor Data Successfully',
            'data'=>new  VendorResource($vendor)
        ],200);
    }
}
