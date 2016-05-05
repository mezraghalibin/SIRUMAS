<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelPopulerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_populer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->string('judul',50);
            $table->string('penulis_utama',30);
            $table->string('dimuat_di',30);
            $table->integer('no');
            $table->integer('halaman');
            $table->integer('tahun');
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
        Schema::drop('artikel_populer');
    }
}
