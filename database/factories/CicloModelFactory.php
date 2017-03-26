<?php

$factory->define(App\Models\Ciclo::class, function(Faker\Generator $faker){

    $days = DateInterval::createFromDateString($faker->numberBetween(7,20) . ' days');
    $dataFine = $faker->dateTime;
    $dataInizio = $dataFine->sub($days);

    return [
        'nome' =>  $faker->unique()->colorName,
        'data_creazione' => date("Y-m-d h:i:sa"),
        'data_inizio' => $dataInizio,
        'data_fine' => $dataFine,
        'obsoleto' => $faker->boolean()
    ];
});

