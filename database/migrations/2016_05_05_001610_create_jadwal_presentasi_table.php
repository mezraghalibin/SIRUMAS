<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalPresentasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_presentasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_laporan')->unsigned();
            $table->dateTime('waktu',50);
            $table->boolean('status',50);
            $table->string('reviewer',50);
            $table->string('ruang',20);
            $table->string('gedung',30);
            $table->integer('staf_riset')->unsigned();
            $table->foreign('staf_riset')->references('id')->on('users');
            $table->foreign('id_laporan')->references('id')->on('laporan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jadwal_presentasi');
    }
}
