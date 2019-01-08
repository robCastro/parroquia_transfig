<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('libro');
            $table->integer('acta');
            $table->integer('pagina');
            //fks
            $table->unsignedInteger('persona_id');
            
            $table->foreign('persona_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confirmas');
    }
}
