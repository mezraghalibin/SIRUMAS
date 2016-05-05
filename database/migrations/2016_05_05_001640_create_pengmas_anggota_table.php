<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengmasAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengmas_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pengmas')->unsigned();
            $table->string('nama_anggota', 30);
            $table->foreign('id_pengmas')->references('id')->on('pengmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pengmas_anggota');
    }
}
