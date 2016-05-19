<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengmas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->string('nama_kegiatan',50);
            $table->string('ketua',30);
            $table->string('peranan', 30);
            $table->string('penyelenggara', 30);
            $table->date('waktu');
            $table->string('tempat', 30);
            $table->string('besar_dana', 30);
            $table->bigInteger('nominal');
            $table->text('bukti');
            $table->foreign('staf_riset')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pengmas');
    }
}
