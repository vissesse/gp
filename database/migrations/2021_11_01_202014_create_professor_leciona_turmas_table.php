<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessorLecionaTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_leciona_turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professors')->cascadeOnDelete();
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas')->cascadeOnDelete();
            $table->integer('cadeira_id')->unsigned();
            $table->foreign('cadeira_id')->references('id')->on('cadeiras')->cascadeOnDelete();
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
        Schema::dropIfExists('professor_leciona_turmas');
    }
}
