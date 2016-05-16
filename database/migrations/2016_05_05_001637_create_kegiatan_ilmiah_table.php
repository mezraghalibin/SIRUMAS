<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanIlmiahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_ilmiah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->string('nama',50);
            $table->string('jenis',20);
            $table->string('skala', 20);
            $table->date('waktu');
            $table->string('tempat',30);
            $table->string('sumber_dana',30);
            $table->string('pembicara',30);
            $table->text('bukti')->nullable();
            $table->foreign('staf_riset')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::drop('kegiatan_ilmiah');
    }
}
