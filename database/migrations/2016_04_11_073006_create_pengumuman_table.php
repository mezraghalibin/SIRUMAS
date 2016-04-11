<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->increments('id_pengumuman');
            $table->string('nomor',50)->nullable();
            $table->string('staf_riset',25);
            $table->timestamp('tgl_post');
            $table->string('judul',50);
            $table->boolean('status');
            $table->string('kategori',15);
            $table->text('konten');
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
        Schema::drop('pengumuman');
    }
}
