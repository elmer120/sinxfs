<?php

use Faker\Generator as Faker;
use App\Models\Associazione;

$factory->define(App\Models\Utente::class, function (Faker $faker) {
    return [
        "nome" => $faker->name,
        "password" => $faker->password,
        "email" => $faker->email,
        "email_verified_at" => null,
        "livello" => $faker->randomDigit,
        "immagine" => $faker->imageUrl(640,400),
        "ultimo_accesso" => null,
        "remember_token" => $faker->md5,
        "created_at" => $faker->datetime(),
        "updated_at" => $faker->datetime(),
        "fk_associazioni" => Associazione::inRandomOrder()->first()->id
    ];
});
