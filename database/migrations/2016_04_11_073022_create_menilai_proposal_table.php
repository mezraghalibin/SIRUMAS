<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenilaiProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menilai_proposal', function (Blueprint $table) {
            $table->integer('id_proposal')->unsigned();
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->unique(['id_proposal','staf_riset']);
            $table->foreign('id_proposal')->references('id')->on('proposal');
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
        Schema::drop('menilai_proposal');
    }
}
