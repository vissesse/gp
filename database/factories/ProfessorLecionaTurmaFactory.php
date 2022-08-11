<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\ProfessorLecionaTurma;
use Faker\Generator as Faker;

$factory->define(ProfessorLecionaTurma::class, function (Faker $faker) {
    return [

        'professor_id' => 1,
        'turma_id' => random_int(2, 4),
        'cadeira_id' => 3,#random_int(1, 60)
        //
    ];
});
