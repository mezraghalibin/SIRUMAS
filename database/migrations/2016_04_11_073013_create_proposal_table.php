<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pengaju',30);
            $table->string('no_hp',20);
            $table->string('e-mail', 50);
            $table->string('nip/nup', 20);
            $table->integer('dosen')->unsigned();
            $table->timestamps('tgl_submit');
            $table->string('kategori', 20);
            $table->string('status', 20);
            $table->string('judul_proposal', 50);
            $table->text('file');
            $table->integer('id_hibah')->unsigned();
            $table->foreign('dosen')->references('id')->on('users');
            $table->foreign('id_hibah')->references('id')->on('hibah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('proposal');
    }
}
