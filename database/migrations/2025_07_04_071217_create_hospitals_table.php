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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // ربط بالمستخدم
            $table->string('name'); // اسم المستشفى
            $table->string('owner_name'); // اسم صاحب المستشفى
            $table->string('owner_phone'); // رقم هاتف صاحب المستشفى
            $table->string('address'); // العنوان
            $table->string('hospital_phone'); // رقم هاتف المستشفى
            $table->string('rating')->nullable(); // تقييم
            $table->string('license_number')->unique(); // رقم الترخيص
            $table->date('license_date'); // تاريخ إصدار الترخيص
            $table->string('license_document'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
