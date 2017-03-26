<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCicliTitoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cicli_titoli', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id');
            $table->foreign('ciclo_id')->references('id')->on('cicli');
            $table->integer('titolo_id');
            $table->foreign('titolo_id')->references('id')->on('titoli');
            $table->boolean('obsoleto')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cicli_titoli');
    }
}
