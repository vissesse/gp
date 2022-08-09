<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_lancamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_avaliacao_id')->unsigned();
            $table->foreign('tipo_avaliacao_id')->references('id')->on('tipo_avaliacaos')->cascadeOnDelete();
            $table->date('data_inicio');
            $table->date('data_fim');
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
        Schema::dropIfExists('controle_lancamentos');
    }
}
