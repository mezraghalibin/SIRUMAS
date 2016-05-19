<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenelitianAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelitian_anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_penelitian')->unsigned();
            $table->string('nama_anggota', 30);
            $table->foreign('id_penelitian')->references('id')->on('penelitian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('penelitian_anggota');
    }
}
