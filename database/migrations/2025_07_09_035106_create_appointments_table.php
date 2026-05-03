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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // معرف المريض
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade'); // معرف الطبيب
            $table->dateTime('appointment_date'); // تاريخ ووقت الموعد
            $table->string('status'); // حالة الموعد
            $table->timestamps(); // timestamps for created_at and updated_at
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
