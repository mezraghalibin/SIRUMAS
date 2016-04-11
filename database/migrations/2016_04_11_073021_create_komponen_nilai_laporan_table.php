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
            $table->integer('id_laporan')->unsigned();
            $table->string('reviewer',25);
            $table->primary(['id_laporan','reviewer']);
            $table->foreign('id_laporan')->references('id_laporan')->on('laporan');
            $table->foreign('reviewer')->references('username')->on('users');
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
