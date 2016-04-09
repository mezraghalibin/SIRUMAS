<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id_laporan');
            $table->string('tipe_progres', 20);
            $table->timestamps('tgl_submit');
            $table->string('pengumpul', 30);
            $table->string('judul', 50);
            $table->string('dosen', 25);
            $table->integer('id_proposal', 10)->nullable();
            $table->foreign('dosen')->references('username')->on('users');
            $table->foreign('id_proposal')->references('id_proposal')->on('proposal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('laporan');
    }
}
