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
            $table->string('staf_keuangan',25);
            $table->integer('id_proposal',10);
            $table->timestamps('tgl_komentar');
            $table->text('komentar');
            $table->primary(['staf_keuangan','id_proposal']);
            $table->foreign('staf_keuangan')->references('username')->on('users');
            $table->foreign('id_proposal')->references('id_proposal')->on('proposal');
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
