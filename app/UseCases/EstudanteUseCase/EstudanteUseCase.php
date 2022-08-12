<?php

namespace App\UseCases\EstudanteUSeCase;

use App\Models\Estudante;
use App\repository\implemetions\EstudanteRepository;

class EstudanteUSeCase extends EstudanteRepository{
     
    function __construct(Estudante $model){
        $this->model = $model;
    }

 
}
