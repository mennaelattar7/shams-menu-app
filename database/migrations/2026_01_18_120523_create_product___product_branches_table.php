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
        Schema::create('product___product_branches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('vendor___branches')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product___product_branches');
    }
};
