<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Kazaa API",
 *     version="1.0.0",
 *     description="API documentation for Kazaa system"
 * )
 *
 * @OA\Server(
 *     url="http://localhost",
 *     description="Local server"
 * )
 *
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class OpenApi
{
}
