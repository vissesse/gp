<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatorioModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_models', function (Blueprint $table) {
            $table->id();
            $table->integer('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professors')->cascadeOnDelete();
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->cascadeOnDelete();
            $table->integer('cadeira_id')->unsigned();
            $table->foreign('cadeira_id')->references('id')->on('cadeiras')->cascadeOnDelete();
            $table->string('curso')->default('-');
            $table->string('semestre')->default('-');
            $table->string('processo')->default('-');
            $table->string('estudante')->default('-');
            $table->string('p1')->default('-');
            $table->string('p2')->default('-');
            $table->string('ac')->default('-');
            $table->string('media')->default('-');
            $table->string('exame')->default('-');
            $table->string('recurso')->default('-');
            $table->string('exame_especial')->default('-');
            $table->string('resultado_final')->default('-');
            $table->string('observacao')->default('-');
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
        Schema::dropIfExists('relatorio_models');
    }
}
