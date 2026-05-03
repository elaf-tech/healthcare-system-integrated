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
        Schema::table('appointments', function (Blueprint $table) {
            // نتأكد أن نوع patient_id مناسب
            $table->unsignedBigInteger('patient_id')->change();

            // نضيف المفتاح الأجنبي مباشرة بدون حذف القديم
            $table->foreign('patient_id')->references('identity_number')->on('patients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
        });
    }
};
