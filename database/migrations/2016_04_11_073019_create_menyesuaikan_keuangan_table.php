<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenyesuaikanKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menyesuaikan_keuangan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staf_keuangan')->unsigned();
            $table->integer('id_proposal')->unsigned();
            $table->timestamps('tgl_komentar');
            $table->text('komentar');
            $table->unique(['staf_keuangan','id_proposal']);
            $table->foreign('staf_keuangan')->references('id')->on('users');
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
        Schema::drop('menyesuaikan_keuangan');
    }
}
