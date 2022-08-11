<?php 
namespace App\UseCases\ProfessorUseCase;

use App\Models\Professor;
use App\repository\implemetions\ProfessorRepository;

class ProfessorUseCase extends ProfessorRepository{
    

    public function __construct(Professor $professor)
    {
        $this->model = $professor;
    }
}