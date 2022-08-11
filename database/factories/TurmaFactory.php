<?php

use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Turma;
use Faker\Generator as Faker;

$factory->define(Turma::class, function (Faker $faker) {
    return [
        //

        'nome' => Str::random(10), 'curso_id' => random_int(1, 2),
        'ano_academico'=> rand(1,5).'ano'
    ];
});
