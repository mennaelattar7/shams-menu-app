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
        Schema::create('vendor___packege_subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('package_subscription_id')->unsigned();


            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->string('status');
            $table->decimal('price_at_purchase',8,2);
            $table->decimal('paid_amount',8,2);
            $table->text('reason')->nullable();

            $table->timestamps();

            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('package_subscription_id','jkvjhvjh')->references('id')->on('vendor___package_subscriptions')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor___packege_subscription_histories');
    }
};
