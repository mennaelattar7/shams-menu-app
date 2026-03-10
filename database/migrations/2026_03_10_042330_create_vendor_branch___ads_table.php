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
        Schema::create('vendor_branch___ads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_ad_id')->unsigned();
            $table->bigInteger('branch_id')->unsigned();
            $table->timestamps();

            $table->foreign('vendor_ad_id')->references('id')->on('vendor___ads')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('vendor___branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___ads');
    }
};
