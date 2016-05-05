<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenulisAngIlmiahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penulis_ang_ilmiah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_artikel_ilmiah')->unsigned();
            $table->string('nama_anggota', 30);
            $table->foreign('id_artikel_ilmiah')->references('id')->on('artikel_ilmiah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('penulis_ang_ilmiah');
    }
}
