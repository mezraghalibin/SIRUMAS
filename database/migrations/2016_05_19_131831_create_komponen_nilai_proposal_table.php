<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomponenNilaiProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponen_nilai_proposal', function (Blueprint $table) {
            $table->integer('id_proposal')->unsigned();
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->foreign('id_proposal')->references('id')->on('proposal');
            $table->foreign('staf_riset')->references('id')->on('users');
            $table->text('nama_komp');
            $table->float('nilai',25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('komponen_nilai_proposal');
    }
}
