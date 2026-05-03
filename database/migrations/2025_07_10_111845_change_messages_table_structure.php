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
        // 1. إسقاط الفهارس القديمة أولاً
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['user_id']);
        });

        // 2. تغيير اسم الأعمدة
        Schema::table('messages', function (Blueprint $table) {
            $table->renameColumn('doctor_id', 'sender_id');
            $table->renameColumn('user_id', 'receiver_id');
            $table->renameColumn('content', 'message');
        });

        // 3. إضافة الفهارس الجديدة
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        // التراجع عن التغييرات
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
            
            $table->renameColumn('sender_id', 'doctor_id');
            $table->renameColumn('receiver_id', 'user_id');
            $table->renameColumn('message', 'content');
            
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
