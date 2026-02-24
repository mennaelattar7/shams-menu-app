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
        Schema::create('vendor_branch___feature__status_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('branch_feature_id')->unsigned();

            $table->string('activation_status');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('branch_feature_id','fktablerequaaest')->references('id')->on('vendor_branch___features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___feature__status_histories');
    }
};
