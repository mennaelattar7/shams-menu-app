<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuThemeController extends BaseController
{
    public function update()
    {
        $vendor = $this->vendor;
        dd($vendor->menu_theme);
    }
}
