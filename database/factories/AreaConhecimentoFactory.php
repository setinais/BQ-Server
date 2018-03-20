<?php

use Faker\Generator as Faker;

$factory->define(App\AreaConhecimento::class, function (Faker $faker) {
    return [
        'area_de_conhecimento' => $faker->word,
        'sub_categoria_id' => $faker->numberBetween(1,20),
    ];
});

