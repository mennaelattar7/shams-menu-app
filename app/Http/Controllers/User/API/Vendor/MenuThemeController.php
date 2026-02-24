<?php

namespace App\Http\Controllers\User\API\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vendor__MenuThemeResource;
use Illuminate\Http\Request;

class MenuThemeController extends BaseController
{
    public function update(Request $request)
    {
        $vendor = $this->vendor;
        $menu_theme = $vendor->menu_theme;
        $menu_theme_details = $menu_theme->menu_theme_details;

        $menu_theme->updated_by_id = $this->user->id;
        $menu_theme->main_category_layout = $request->main_category_layout;
        $menu_theme->products_layout = $request->products_layout;
        $menu_theme->theme_name = $request->theme_name;
        $menu_theme->save();
        
        $menu_theme_details->background_color = $request->background_color;
        $menu_theme_details->borders_and_dividers_color = $request->borders_and_dividers_color;
        $menu_theme_details->main_text_color = $request->main_text_color;
        $menu_theme_details->secondary_text_color = $request->secondary_text_color;
        $menu_theme_details->lang_btn_color = $request->lang_btn_color;
        $menu_theme_details->lang_btn_background_color = $request->lang_btn_background_color;
        $menu_theme_details->review_and_working_hours_text_color = $request->review_and_working_hours_text_color;
        $menu_theme_details->card_background_color = $request->card_background_color;
        $menu_theme_details->card_title_color = $request->card_title_color;
        $menu_theme_details->social_media_color = $request->social_media_color;
        $menu_theme_details->main_category_specified_color = $request->main_category_specified_color;
        $menu_theme_details->main_category_not_specified_color = $request->main_category_not_specified_color;
        $menu_theme_details->sub_category_specified_color = $request->sub_category_specified_color;
        $menu_theme_details->sub_category_not_specified_color = $request->sub_category_not_specified_color;
        $menu_theme_details->category_title_color = $request->category_title_color;
        $menu_theme_details->product_title_color = $request->product_title_color;
        $menu_theme_details->product_description_color = $request->product_description_color;
        $menu_theme_details->product_data_color = $request->product_data_color;
        $menu_theme_details->product_image_border_color = $request->product_image_border_color;
        $menu_theme_details->product_price_color = $request->product_price_color;
        $menu_theme_details->product_price_before_discount_color = $request->product_price_before_discount_color;
        $menu_theme_details->offer_background_color = $request->offer_background_color;
        $menu_theme_details->offer_text_color = $request->offer_text_color;
        $menu_theme_details->call_waiter_btn_color = $request->call_waiter_btn_color;
        $menu_theme_details->call_waiter_btn_background_color = $request->call_waiter_btn_background_color;
        $menu_theme_details->favourite_btn_color = $request->favourite_btn_color;
        $menu_theme_details->favourite_icon_color = $request->favourite_icon_color;
        $menu_theme_details->review_btn_text_color = $request->review_btn_text_color;
        $menu_theme_details->review_btn_background_color = $request->review_btn_background_color;
        $menu_theme_details->back_btn_color = $request->back_btn_color;
        $menu_theme_details->back_btn_background_color = $request->back_btn_background_color;
        $menu_theme_details->close_btn_color = $request->close_btn_color;
        $menu_theme_details->close_btn_background_color = $request->close_btn_background_color;
        $menu_theme_details->input_filed_background_color = $request->input_filed_background_color;
        $menu_theme_details->input_filed_text_color = $request->input_filed_text_color;
        $menu_theme_details->additional_information_color = $request->additional_information_color;
        $menu_theme_details->font_family = $request->font_family;
        $menu_theme_details->save();

        return response()->json([
            'success' =>true,
            'message' => 'Theme Is Updated',
        ],200);
    }

    public function getVendorTheme()
    {
        $menu_theme = $this->vendor->menu_theme;
        return response()->json([
            'success' => true,
            'message' => 'get menu theme successfully',
            'data' => new Vendor__MenuThemeResource($menu_theme)
        ],200);
    }
}
