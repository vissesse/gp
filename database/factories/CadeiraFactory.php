<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\CursoAnoAcademicoCadeira::class, function (Faker $faker) {
    return [
        //
        'curso_id' => random_int(1, 2),
        'cadeira_id' => random_int(1, 60),
        'ano_academico' => random_int(1, 5) . "ano",
        'semestre' => random_int(1, 10) . "semestre"

    ];
});
