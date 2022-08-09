<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoAnoAcademicoCadeirasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_ano_academico_cadeiras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos')->cascadeOnDelete();
            $table->integer('cadeira_id')->unsigned();
            $table->foreign('cadeira_id')->references('id')->on('cadeiras')->cascadeOnDelete();
            $table->string('ano_academico');
            $table->string('semestre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_ano_academico_cadeiras');
    }
}
