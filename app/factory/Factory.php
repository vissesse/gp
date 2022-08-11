<?php

namespace App\factory;

use App\UseCases\TurmaUseCase\TurmaUseCase;
use App\Models\Turma;
use App\factory\IUseCases;
use App\UseCases\CadeiraUseCase\CadeiraUseCase;
use App\UseCases\ClassificacaoUseCase\ClassificacaoUseCase;
use App\UseCases\CursoUseCase\CursoUseCase;
use App\UseCases\EstudanteUSeCase\EstudanteUSeCase;
use App\UseCases\ProfessorUseCase\ProfessorUseCase;

class Factory implements IUseCases
{

    public function turma()
    {
        return  new TurmaUseCase(new \App\Models\Turma);
    }

    function estudante()
    {
        return new EstudanteUSeCase(new \App\Models\Estudante);
    }
    function professor()
    {
        return  new ProfessorUseCase(new \App\Models\Professor);
    }
    function cadeira()
    {
        return new CadeiraUseCase(new \App\Models\Cadeira);
    }

    function curso()
    {

        return new CursoUseCase(new \App\Models\Curso);
    }
    function classificacoes()
    {
        return new ClassificacaoUseCase(new \App\Models\Classificacoe);
    }
}
