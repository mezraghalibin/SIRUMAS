<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipe_progres', 20);
            $table->timestamps();
            $table->string('judul', 50);
            $table->string('judul_laporan_akhir', 50);
            $table->string('judul_laporan_kemajuan', 50);
            $table->boolean('flag_kemajuan');
            $table->boolean('flag_akhir')->nullable();
            $table->integer('dosen')->unsigned();
            $table->integer('id_proposal')->unsigned();
            $table->boolean('file_kemajuan')->nullable();
            $table->boolean('file_akhir');
            $table->foreign('dosen')->references('id')->on('users');
            $table->foreign('id_proposal')->references('id')->on('proposal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('laporan');
    }
}
