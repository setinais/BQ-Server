<?php

use Faker\Generator as Faker;

$factory->define(App\ControleAcesso::class, function (Faker $faker) {
    return [
    	'user_id' => null,
        'role' => $faker->randomElement(['admin', 'professor', 'client','pendente','aluno'])
    ];
});
