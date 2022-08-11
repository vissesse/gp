<?php

namespace App\UseCases\ClassificacaoUseCase;

use App\Models\Classificacoe;
use App\repository\implemetions\ClassificacoesRepository;

class ClassificacaoUseCase extends ClassificacoesRepository{
     
    function __construct(Classificacoe $model){
        $this->model = $model;
    }
 
}
