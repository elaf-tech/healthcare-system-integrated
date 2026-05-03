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
    Schema::table('doctor_schedules', function (Blueprint $table) {
        // حذف المفتاح الخارجي المرتبط بـ doctor_id
        $table->dropForeign(['doctor_id']); // تأكد من أن اسم العمود صحيح

        // الآن يمكنك حذف العمود
        $table->dropColumn('doctor_id'); 

        // إضافة عمود user_id
        $table->unsignedBigInteger('user_id')->after('id');

        // إضافة مفتاح خارجي جديد
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('doctor_schedules', function (Blueprint $table) {
        // حذف المفتاح الخارجي لـ user_id
        $table->dropForeign(['user_id']);

        // حذف user_id
        $table->dropColumn('user_id');

        // إعادة إضافة doctor_id
        $table->unsignedBigInteger('doctor_id')->after('id');

        // إضافة المفتاح الخارجي مرة أخرى
        $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
    });
}
};
