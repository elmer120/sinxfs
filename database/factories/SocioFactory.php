<?php

use Faker\Generator as Faker;
use App\Models\SocioTipologia;


$factory->define(App\Models\Socio::class, function (Faker $faker) {
    return [
        'certificato_scadenza_al' => $faker->date(),
        'richiesta_data' => $faker->date(),
        'approvazione_data' => $faker->date(),
        'quota_scadenza_al' => $faker->date(),
        'scadenza_data' => $faker->date(),
        'fk_soci_tipologie' => SocioTipologia::inRandomOrder()->first()->id
    ];
});