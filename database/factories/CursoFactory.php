<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Curso;
use Faker\Generator as Faker;

$factory->define(Curso::class, function (Faker $faker) {
    return [
        //
        'nome' => $faker->jobTitle,
        'anos_academico' => random_int(1, 5)
    ];
});
