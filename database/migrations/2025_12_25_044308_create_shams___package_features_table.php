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
        Schema::create('shams___package_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('feature_id')->unsigned();

            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('shams___vendor_packages')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('shams___features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shams___package_features');
    }
};
