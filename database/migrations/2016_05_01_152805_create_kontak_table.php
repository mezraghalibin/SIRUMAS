<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
      Schema::create('kontak', function (Blueprint $table) {
        $table->increments('id');
        $table->string('phone',15);
        $table->string('email', 255);
        $table->string('nama', 255);
        $table->text('foto');
        $table->string('institusi', 50);  
        $table->string('expertise',255);
        $table->text('deskripsi');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //
    }
}
