<?php


use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Estudante;
use Faker\Generator as Faker;

$factory->define(Estudante::class, function (Faker $faker) {
    return [
        //
        'user_id'=>random_int(1,30),

        'nome' => $faker->name,
        'turma_id' => random_int(1, 20),
        'processo' => Str::random(10, 500),

    ];
});
