<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\ControleLancamento::class, function (Faker $faker) {
    return [

        'data_inicio' => $faker->date,
        'data_fim' => $faker->date
        //
    ];
});
