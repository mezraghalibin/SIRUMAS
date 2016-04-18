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
            $table->increments('id');
            $table->string('nomor',50)->nullable();
            $table->integer('staf_riset')->unsigned();
            $table->timestamps();
            $table->string('judul',50);
            $table->boolean('status');
            $table->string('kategori',15);
            $table->text('konten');
            $table->text('file')->nullable();
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
        Schema::drop('pengumuman');
    }
}
