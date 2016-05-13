<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTerlibatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_terlibat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_penelitian')->unsigned();
            $table->string('nama_mhs', 30);
            $table->foreign('id_penelitian')->references('id')->on('penelitian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mahasiswa_terlibat');
    }
}
