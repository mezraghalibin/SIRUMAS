<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenilaiLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menilai_laporan', function (Blueprint $table) {
            $table->integer('id_laporan',10);
            $table->string('reviewer',25);
            $table->primary(['id_laporan','reviewer']);
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan');
            $table->foreign('reviewer')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menilai_laporan');
    }
}
