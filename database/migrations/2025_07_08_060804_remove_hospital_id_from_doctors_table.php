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
        Schema::table('doctors', function (Blueprint $table) {
            // حذف قيد المفتاح الخارجي
            $table->dropForeign(['hospital_id']); // تأكد من أن الاسم هنا صحيح
            // الآن يمكنك حذف العمود
            $table->dropColumn('hospital_id');
        });
    }

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            // إعادة إنشاء العمود
            $table->unsignedBigInteger('hospital_id')->nullable();
            // إعادة إنشاء قيد المفتاح الخارجي
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }
};
