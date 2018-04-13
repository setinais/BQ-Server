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
	
	$alternativas.= "]";    
	return [
        'enunciado' => $faker->text,
        'alternativas' => json_encode($setences),
        'alternativa_correta' => $faker->numberBetween(0,(count($setences)-1)),
        'nivel' => $faker->randomDigit,
        'sub_categoria' => $faker->numberBetween(1,420),
        //'disciplina_id' => $faker->numberBetween(1,20),
        'professor_id' => $faker->numberBetween(1,100)
    ];
});
