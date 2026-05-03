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
                Schema::table('appointments', function (Blueprint $table) {
                    // 1. إعادة تسمية العمود (أو إنشاء عمود جديد إذا كنت تفضل ذلك)
                    $table->renameColumn('doctor_id', 'user_id');
                    
                    // 2. تعديل المفتاح الخارجي
                    $table->dropForeign(['doctor_id']);
                    $table->foreign('user_id')
                          ->references('id')
                          ->on('users')
                          ->onDelete('cascade');
                });
            }
        
            public function down()
            {
                Schema::table('appointments', function (Blueprint $table) {
                    $table->renameColumn('user_id', 'doctor_id');
                    $table->dropForeign(['user_id']);
                    $table->foreign('doctor_id')
                          ->references('id')
                          ->on('doctors') // إذا كنت تريد العودة لجدول doctors
                          ->onDelete('cascade');
                });
            }
};
