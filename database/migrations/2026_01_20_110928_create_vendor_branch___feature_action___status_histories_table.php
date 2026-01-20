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
        Schema::create('vendor_branch___feature_action___status_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_feature_action_id')->unsigned();
            $table->bigInteger('executed_by_id')->unsigned();


            $table->timestamp('exexuted_at');
            $table->enum('status',['completed','pending','canceled']);
            $table->text('status_reason')->nullable();

            $table->timestamps();

            $table->foreign('branch_feature_action_id')->references('id')->on('vendor_branch___feature_actions')->onDelete('cascade');
            $table->foreign('executed_by_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___feature_action___status_histories');
    }
};
