<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\TipoAvaliacao;
use Faker\Generator as Faker;

$factory->define(TipoAvaliacao::class, function (Faker $faker) {
    $tipo_avalicao = ["primeira Prova", 'Segunda prova', "Exame", "Recurso"];

    return [
        //
        'nome' => $tipo_avalicao[random_int(0, 3)],
        'curso_id' => random_int(1, 2)
    ];
});
