<?php

use Faker\Generator as Faker;

$factory->define(App\Questao::class, function (Faker $faker) {
	$ids = '[';
	for ($i=0; $i <  $faker->randomDigit; $i++) { 
		$ids .= $faker->numberBetween(21,400).',';
	}
	$ids .= 'null]';

	$alternativas = "[";
	$setences = $faker->sentences($faker->numberBetween(4,5),false);
	foreach ($setences as $key => $value) {
		$alternativas .= $value.",";
	}
	$alternativas.= "]";    return [
        'enunciado' => $faker->text,
        'alternativas' => json_encode($alternativas),
        'nivel' => $faker->randomDigit,
        'sub_categoria' => json_encode($ids),
        'disciplina_id' => $faker->numberBetween(1,20),
        'professor_id' => $faker->numberBetween(1,100)
    ];
});
