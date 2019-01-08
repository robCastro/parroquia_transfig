<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrimonios', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('libro');
            $table->integer('folio');

            //fks
            $table->unsignedInteger('esposo_id');
            $table->unsignedInteger('esposa_id');

            $table->foreign('esposo_id')->references('id')->on('personas');
            $table->foreign('esposa_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matrimonios');
    }
}
