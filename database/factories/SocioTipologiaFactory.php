<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SocioTipologia::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
    ];
});