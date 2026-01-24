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
        Schema::create('customer___favourites', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('branch_id')->unsigned();

            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('vendor___branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer___favourites');
    }
};
