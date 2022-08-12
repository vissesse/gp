<?php

namespace App\UseCases\TurmaUseCase;

use App\Models\Turma;
use App\repository\implemetions\TurmaRepository;
use App\repository\interfaces\ITurma;

class TurmaUseCase extends TurmaRepository implements ITurma
{   
    
    public function __construct(Turma $turma) {   
        $this->model =$turma;
    } 

    public function filter_by_curso($curso_id){
        return $this->model::where('curso_id', $curso_id)->get();
    }

}