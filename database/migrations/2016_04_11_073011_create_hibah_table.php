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
            $table->increments('id_hibah');
            $table->string('nama_hibah',50);
            $table->text('deskripsi');
            $table->string('kategori_hibah', 30);
            $table->string('besar_dana', 15);
            $table->string('pemberi', 30);  
            $table->timestamp('tgl_awal');
            $table->timestamp('tgl_akhir');
            $table->string('staf_riset',25);
            $table->foreign('staf_riset')->references('username')->on('users');
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
