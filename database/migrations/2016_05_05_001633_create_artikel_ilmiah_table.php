<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelIlmiahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_ilmiah', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->string('judul',50);
            $table->string('penulis_utama',30);
            $table->string('nama_jurnal');
            $table->string('level', 30);
            $table->string('issn',20);
            $table->integer('no');
            $table->string('volume',20);
            $table->integer('tahun');
            $table->integer('halaman');
            $table->text('url');
            $table->string('penerbit');
            $table->text('bukti')->nullable();
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
        Schema::drop('artikel_ilmiah');
    }
}
