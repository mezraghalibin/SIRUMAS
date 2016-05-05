<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemakalahAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakalah_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_konf')->unsigned();
            $table->string('nama_anggota', 30);
            $table->foreign('id_konf')->references('id')->on('artikel_konferensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pemakalah_anggota');
    }
}
