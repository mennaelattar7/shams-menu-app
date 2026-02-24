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
        Schema::create('user___account_status_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('updated_by_id')->unsigned()->nullable();
            $table->bigInteger('deleted_by_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();

            $table->enum('status', ['active', 'inactive','pending_review','suspended']);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user___account_status_histories');
    }
};
