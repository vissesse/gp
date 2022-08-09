<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Professor;
use Faker\Generator as Faker;

$factory->define(Professor::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->email,
        'contacto' => random_int(202.424243,3223),#$faker->phoneNumber,
        'Especialidade' => $faker->jobTitle
    ];
});
