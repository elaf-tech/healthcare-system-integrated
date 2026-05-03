<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::dropIfExists('doctor_week_schedules');
}

public function down()
{
    // يمكنك هنا إعادة إنشاء الجدول إذا أردت التراجع
    Schema::create('doctor_week_schedules', function (Blueprint $table) {
        $table->id();
            $table->foreignId('doctor_id')->constrained();
            $table->enum('day', ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']);
            $table->time('morning_start')->nullable();
            $table->time('morning_end')->nullable();
            $table->time('afternoon_start')->nullable();
            $table->time('afternoon_end')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
    });
}
};
