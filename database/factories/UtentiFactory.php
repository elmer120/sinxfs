<?php

use Faker\Generator as Faker;
use App\Models\Associazione;

$factory->define(App\Models\Utente::class, function (Faker $faker) {
    return [
        "nome" => $faker->name,
        "password" => $faker->password,
        "immagine" => $faker->imageUrl(640,400),
        "email" => $faker->email,
        "livello" => $faker->randomDigit,
        "creato_al" => $faker->datetime(),
        "aggiornato_al" => $faker->datetime(),
        "remember_token" => $faker->md5,
        "ultimo_accesso" => $faker->datetime(),
        "fk_associazioni" => Associazione::inRandomOrder()->id
    ];
});
