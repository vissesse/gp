<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Classificacao::class, function (Faker $faker) {
    return [
        //
        'nota' => random_int(0, 20),
        'ano_lectivo' => $faker->date
    ];
});
