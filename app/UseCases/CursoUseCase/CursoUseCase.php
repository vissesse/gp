<?php

namespace App\UseCases\CursoUseCase;

use App\Models\Curso;
use App\repository\implemetions\CursoRepository;

class CursoUseCase extends CursoRepository{


    public function __construct(Curso $curso)
    {
        $this->model =$curso;
    }

}