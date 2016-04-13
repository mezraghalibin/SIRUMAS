<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomponenNilaiLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponen_nilai_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_laporan')->unsigned();
            $table->integer('reviewer')->unsigned();
            $table->unique(['id_laporan','reviewer']);
            $table->foreign('id_laporan')->references('id')->on('laporan');
            $table->foreign('reviewer')->references('id')->on('users');
            $table->text('nama_komp');
            $table->float('nilai',25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('komponen_nilai_laporan');
    }
}
