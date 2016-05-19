<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHibahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hibah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_hibah',50);
            $table->text('deskripsi');
            $table->string('kategori_hibah', 30);
            $table->string('besar_dana', 30);
            $table->bigInteger('nominal');
            $table->string('pemberi', 30);  
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->timestamps();
            $table->boolean('status');
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
        Schema::drop('hibah');
    }
}
