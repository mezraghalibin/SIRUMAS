<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMouPenelitiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mou_peneliti', function (Blueprint $table) {
            $table->increments('id_mou');
            $table->text('file');
            $table->string('peneliti',30);
            $table->string('judul',50);
            $table->string('staf_riset',25);
            $table->foreign('staf_riset')->references('username')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mou_peneliti');
    }
}
