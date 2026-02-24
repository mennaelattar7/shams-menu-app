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
        Schema::create('vendor_branch___feature_actions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->unsigned();
            $table->bigInteger('action_id')->unsigned();
            $table->bigInteger('table_id')->unsigned();

            $table->integer('action_number');
            $table->enum('current_status',['completed','pending','canceled']);

            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('vendor___branches')->onDelete('cascade');
            $table->foreign('action_id')->references('id')->on('shams___vendor_feature_actions')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('vendor_branch___tables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___feature_actions');
    }
};
