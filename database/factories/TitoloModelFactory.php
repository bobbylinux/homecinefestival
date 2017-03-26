<?php

$factory->define(App\Models\Titolo::class, function(Faker\Generator $faker){

    return [
        'titolo' =>  $faker->unique()->firstName . ' ' . $faker->unique()->lastName,
        'titolo_originale' =>  $faker->unique()->firstName . ' ' . $faker->unique()->lastName,
        'data_uscita' => $faker->date('Y-m-d')
    ];
});
