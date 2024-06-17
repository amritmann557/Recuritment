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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('unqiue_id');
            $table->string('orderDate');
            $table->string('ownerTo');
            $table->string('orderTo');
            $table->string('customerName');
            $table->string('manufacturedDate');
            $table->string('jobName');
            $table->string('deliveryDate');
            $table->string('contact_number');
            $table->string('estimateNumber');
            $table->string('city');
            $table->string('emailAddress');
            $table->string('modeOfDelivery');
            $table->string('productCode');
            $table->string('priceDetails');
            $table->string('quantity');
            $table->string('manufacturedBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
