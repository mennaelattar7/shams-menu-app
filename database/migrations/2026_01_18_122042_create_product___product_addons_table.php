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
        Schema::create('product___product_addons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('addon_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->decimal('price',10,2);

            $table->timestamps();

            $table->foreign('addon_id')->references('id')->on('shams___product_addons')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product___product_addons');
    }
};
