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
            $table->integer('id_proposal',10);
            $table->string('staf_riset',25);
            $table->primary(['id_proposal','staf_riset']);
            $table->foreign('id_proposal')->references('id_proposal')->on('proposal');
            $table->foreign('staf_riset')->references('username')->on('users');
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
