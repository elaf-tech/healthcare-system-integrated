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
            $table->string('day')->after('doctor_id'); // يمكنك تحديد الموقع المناسب

            // إضافة عمود الوقت
            $table->time('time')->after('day'); // يمكنك تحديد الموقع المناسب

            // حذف عمود appointment_date
            $table->dropColumn('appointment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['day', 'time']);

            // إعادة إضافة عمود appointment_date
            $table->date('appointment_date'); 
        });
    }
};
