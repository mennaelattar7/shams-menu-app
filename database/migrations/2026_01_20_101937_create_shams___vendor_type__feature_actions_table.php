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
        Schema::create('shams___vendor_type__feature_actions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_type_id')->unsigned();
            $table->bigInteger('action_id')->unsigned();

            $table->timestamps();

            $table->foreign('vendor_type_id')->references('id')->on('shams___vendor_types')->onDelete('cascade');
            $table->foreign('action_id')->references('id')->on('shams___vendor_feature_actions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shams___vendor_type__feature_actions');
    }
};
