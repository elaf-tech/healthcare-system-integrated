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
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger('identity_number')->change();

            // ثم اضف مفتاح أجنبي يربطه ب users.id
            $table->foreign('identity_number')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['identity_number']);

            // ارجع العمود كنوعه السابق (على سبيل المثال string)
            $table->string('identity_number')->change();
        });
    }
};
