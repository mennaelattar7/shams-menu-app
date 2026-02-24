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
        Schema::create('vendor___menu_themes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('updated_by_id')->unsigned()->nullable();
            $table->bigInteger('vendor_id')->unsigned();

            $table->enum('main_category_layout',['bottom_line','rounded_edges'])->default('bottom_line');
            $table->enum('products_layout',['list','grid','compact'])->default('list');
            $table->enum('theme_name',['light','dark','custom'])->default('light');
            
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor___menu_themes');
    }
};
