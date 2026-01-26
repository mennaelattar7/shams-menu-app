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
        Schema::create('vendor_branch___table_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('branch_table_id')->unsigned();

            $table->string('request_number')->comment('B:branch_id/T:table_number-table_id/request_number');
            $table->enum('request_type', ['invoice', 'issue', 'ready_to_order','other']);
            $table->enum('status', ['pending', 'in_progress', 'done','cancelled']);
            $table->timestamp('requested_at');
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();


            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('branch_table_id')->references('id')->on('vendor_branch___tables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_branch___table_requests');
    }
};
