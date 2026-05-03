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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->enum('day_of_week', [
                'saturday', 'sunday', 'monday', 
                'tuesday', 'wednesday', 'thursday', 'friday'
            ]);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('session_type')->default('working'); // working, break, prayer
            $table->boolean('is_recurring')->default(true);
            $table->date('valid_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
