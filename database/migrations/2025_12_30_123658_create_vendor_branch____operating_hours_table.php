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
        Schema::create('vendor_branch___operating_hours', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('updated_by_id')->unsigned()->nullable();
            $table->bigInteger('deleted_by_id')->unsigned()->nullable();
            $table->bigInteger('branch_id')->unsigned();

            $table->tinyInteger('day_of_week');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->enum('is_open',['yes','no']);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('vendor___branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___operating_hours');
    }
};
