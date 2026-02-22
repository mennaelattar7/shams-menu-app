<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuThemeController extends BaseController
{
    public function update(Request $request)
    {
        $vendor = $this->vendor;
        $menu_theme = $vendor->menu_theme;
        $menu_theme_details = $menu_theme->menu_theme_details;
        dd($menu_theme_details);
        $menu_theme->updated_by_id = $this->user->id;
        $menu_theme->main_category_layout = $request->main_category_layout;
        $menu_theme->products_layout = $request->products_layout;
        $menu_theme->theme_name = $request->theme_name;
        $menu_theme->save();
        if($request->theme_name == "light")
        {

        }

    }
}
