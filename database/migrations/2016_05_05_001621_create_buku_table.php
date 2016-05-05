<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul',50);
            $table->string('penulis',50);
            $table->string('penerbit',30);
            $table->string('isbn',20);
            $table->integer('tahun');
            $table->text('sampul');
            $table->integer('staf_riset')->unsigned();
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
        Schema::drop('buku');
    }
}
