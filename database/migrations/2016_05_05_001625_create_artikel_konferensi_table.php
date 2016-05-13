<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelKonferensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel_konferensi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staf_riset')->unsigned();
            $table->string('judul',50);
            $table->string('pemakalah',30);
            $table->date('waktu');
            $table->string('tempat',30);
            $table->string('tingkat',20);
            $table->string('penyelenggara',20);
            $table->text('website');
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
        Schema::drop('artikel_konferensi');
    }
}
