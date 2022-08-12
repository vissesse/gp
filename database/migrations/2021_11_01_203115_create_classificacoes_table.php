<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

class CreateClassificacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classificacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estudante_id')->unsigned();
            $table->foreign('estudante_id')->references('id')->on('estudantes')->cascadeOnDelete();
            $table->integer('curso_ano_academico_cadeira_id')->unsigned();
            $table->foreign('curso_ano_academico_cadeira_id')->references('id')->on('curso_ano_academico_cadeiras')->cascadeOnDelete();
            $table->integer('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professors')->cascadeOnDelete();
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('CASCADE');
            //$table->integer('nota_id')->unsigned();
            //$table->foreign('nota_id')->references('id')->on('notas')->cascadeOnDelete();
            $table->string('ano_lectivo')->default(date("Y"));
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
        Schema::dropIfExists('classificacoes');
    }
}
