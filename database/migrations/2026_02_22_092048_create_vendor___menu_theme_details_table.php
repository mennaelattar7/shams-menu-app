<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor___menu_theme_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_theme_id')->unsigned();

            $table->string('background_color');
            $table->string('borders_and_dividers_color');
            $table->string('main_text_color');
            $table->string('secondary_text_color');
            $table->string('lang_btn_color');
            $table->string('lang_btn_background_color');
            $table->string('review_and_working_hours_text_color');
            $table->string('card_background_color');
            $table->string('card_title_color');
            $table->string('social_media_color');
            $table->string('main_category_specified_color');
            $table->string('main_category_not_specified_color');
            $table->string('sub_category_specified_color');
            $table->string('sub_category_not_specified_color');
            $table->string('category_title_color');
            $table->string('product_title_color');
            $table->string('product_description_color');
            $table->string('product_data_color');
            $table->string('product_image_border_color');
            $table->string('product_price_color');
            $table->string('product_price_before_discount_color');
            $table->string('offer_background_color');
            $table->string('offer_text_color');
            $table->string('call_waiter_btn_color');
            $table->string('call_waiter_btn_background_color');
            $table->string('favourite_btn_color');
            $table->string('favourite_icon_color');
            $table->string('review_btn_text_color');
            $table->string('review_btn_background_color');
            $table->string('back_btn_color');
            $table->string('back_btn_background_color');
            $table->string('close_btn_color');
            $table->string('close_btn_background_color');
            $table->string('input_filed_background_color');
            $table->string('input_filed_text_color');
            $table->string('additional_information_color');
            $table->string('font_family');

            $table->timestamps();

            $table->foreign('menu_theme_id')->references('id')->on('vendor___menu_themes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor___menu_theme_details');
    }
};
