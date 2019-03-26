<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->date('fechanac')->nullable();
            $table->boolean('sexo')->nullable();
            $table->string('papa')->nullable();
            $table->string('mama')->nullable();

            //Fks
            $table->unsignedInteger('id_nacionalidad');
            $table->unsignedInteger('id_municipio')->nullable();

            $table->foreign('id_nacionalidad')->references('id')->on('nacionalidades');
            $table->foreign('id_municipio')->references('id')->on('municipios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
