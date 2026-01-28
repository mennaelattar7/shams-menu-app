<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        // 🔥 مهم جدًا
        if ($request->expectsJson()) {
            return null;
        }

        return null; // علشان ميعملش redirect نهائي
    }
}
