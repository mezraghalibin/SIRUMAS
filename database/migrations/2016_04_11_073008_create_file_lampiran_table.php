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
            $table->integer('id_pengumuman')->unsigned();
            $table->string('file');
            $table->foreign('id_pengumuman')->references('id_pengumuman')->on('pengumuman')->onDelete('cascade');
            $table->primary(array('id_pengumuman','file'));
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
