<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileLampiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_lampiran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pengumuman')->unsigned();
            $table->foreign('id_pengumuman')->references('id')->on('pengumuman')->onDelete('cascade');
            $table->string('file', 30);
            $table->unique(array('id_pengumuman','file'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('file_lampiran');
    }
}
