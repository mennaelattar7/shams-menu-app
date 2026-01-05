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
        Schema::create('vendor_branch___offer_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('updated_by_id')->unsigned()->nullable();
            $table->bigInteger('deleted_by_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('offer_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('vendor_branch___offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___offer_products');
    }
};
