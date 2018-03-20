<?php

use Faker\Generator as Faker;

$factory->define(App\Professor::class, function (Faker $faker) {
    return [
        'nome_prof' => $faker->name,
        'matricula_prof' => $faker->randomNumber(9,false),
        'cpf' => $faker->randomNumber(9,false),
        'user_id' => function () {
        	return factory(App\User::class)->create()->id;
        },
        'documento_comprovante' => '01010101010101010010101010'
    ];
});
