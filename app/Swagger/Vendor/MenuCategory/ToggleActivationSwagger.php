<?php

namespace App\Swagger\Vendor\MenuCategory;
/**
 * @OA\Post(
 *     path="/api/{locale}/user/vendor/menu-categories/{category_slug}/toggle-activation",
 *     tags={"Vendor - Menu Category"},
 *     operationId="Change Toggle Menu Category activation",
 *     summary="---Change Toggle Menu Category activation---",
 *     description="Change Toggle Menu Category activation",
 *
 *     @OA\Parameter(
 *         name="locale",
 *         in="path",
 *         required=true,
 *         description="Language code",
 *         @OA\Schema(type="string", example="en")
 *     ),
 *     @OA\Parameter(
 *         name="category_slug",
 *         in="path",
 *         required=true,
 *         description="the sluge of Category",
 *         @OA\Schema(type="string", example="category-slug")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Change Avilabilty",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="string", example="true"),
 *             @OA\Property(property="message", type="string", example="Change Category activation Succefully"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Authenticated"
 *     )
 * )
 */

class ToggleActivationSwagger {}
