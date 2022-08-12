<?php

namespace App\UseCases\CadeiraUseCase;

use App\Models\Cadeira;
use App\repository\implemetions\CadeiraRepository; 

class CadeiraUseCase extends CadeiraRepository{


    public function __construct(Cadeira $curso)
    {
        $this->model =$curso;
    }

}