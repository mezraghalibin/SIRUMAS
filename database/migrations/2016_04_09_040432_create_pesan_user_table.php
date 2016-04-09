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
            $table->string('username', 25);
            $table->increments('id_pesan');
            $table->primary('username','id_pesan');
            $table->string('penerima', 25);
            $table->boolean('isread');
            $table->string('subjek', 30);
            $table->text('pesan');
            $table->timestamps('tgl_notif');
            $table->text('file')->nullable();
            $table->foreign('username')->references('username')->on('users');
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
