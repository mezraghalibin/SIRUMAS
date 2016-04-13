<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesanUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_user', function (Blueprint $table) {
            $table->integer('id_pengirim')->unsigned();
            $table->increments('id');
            $table->string('penerima', 25);
            $table->boolean('isread');
            $table->string('subjek', 30);
            $table->text('pesan');
            $table->timestamps('tgl_notif');
            $table->text('file')->nullable();
            $table->foreign('id_pengirim')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pesan_user');
    }
}
