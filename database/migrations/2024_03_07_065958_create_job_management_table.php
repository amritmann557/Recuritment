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
        Schema::create('job_management', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->string('jobTitle');
            $table->string('description');
            $table->string('experience');
            $table->string('language');
            $table->string('gender');
            $table->string('salary');
            $table->string('vacancy');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_management');
    }
};
