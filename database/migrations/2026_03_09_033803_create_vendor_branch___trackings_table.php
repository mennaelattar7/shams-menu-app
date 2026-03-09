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
        Schema::create('vendor_branch___trackings', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();

            $table->text('uuid');
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('vendor___branches')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___trackings');
    }
};
