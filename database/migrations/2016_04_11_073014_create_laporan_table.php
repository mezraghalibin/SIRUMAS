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
            $table->increments('id');
            $table->string('tipe_progres', 20);
            $table->timestamps('tgl_submit');
            $table->string('pengumpul', 30);
            $table->string('judul', 50);
            $table->integer('dosen')->unsigned();
            $table->integer('id_proposal')->nullable()->unsigned();
            $table->foreign('dosen')->references('id')->on('users');
            $table->foreign('id_proposal')->references('id')->on('proposal');
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
