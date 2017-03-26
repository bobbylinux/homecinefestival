<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicliTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicli',function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->dateTime('data_creazione');
            $table->boolean('obsoleto');
            $table->dateTime('data_inizio');
            $table->dateTime('data_fine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cicli');
    }
}
