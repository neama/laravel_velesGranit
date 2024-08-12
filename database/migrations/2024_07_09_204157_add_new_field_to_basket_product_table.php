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
        Schema::table('basket_product', function (Blueprint $table) {
            $table->string('option')->nullable(); // Добавляем новое поле
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basket_product', function (Blueprint $table) {
            $table->dropColumn('option'); // Удаляем поле при откате миграции
        });
    }
};
