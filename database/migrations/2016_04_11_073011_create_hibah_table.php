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
            $table->integer'besar_dana', 30);
            $table->string('rupiah', 30);
            $table->string('pemberi', 30);  
            $table->string('tgl_awal',255);
            $table->string('tgl_akhir',255);
            $table->integer('staf_riset')->unsigned();
            $table->foreign('staf_riset')->references('id')->on('users');
            $table->boolean('status');
            $table->timestamp();
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
