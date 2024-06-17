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
        Schema::create('quotation_management', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->string('quotationNumber');
            $table->string('customerName');
            $table->string('total_amount');
            $table->string('amount_received');
            $table->string('pending_balance');
            $table->string('uploadQuotation');
            $table->string('quotationDate');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_management');
    }
};
