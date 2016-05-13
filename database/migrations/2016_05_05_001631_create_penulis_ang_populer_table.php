<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenulisAngPopulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penulis_ang_populer', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_artikel_populer')->unsigned();
            $table->string('nama_anggota', 30);
            $table->foreign('id_artikel_populer')->references('id')->on('artikel_populer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('penulis_ang_populer');
    }
}
