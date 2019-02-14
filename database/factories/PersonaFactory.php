<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Persona::class, function (Faker $faker) {
   
    
    return [
        'nome' => $faker->firstName,
        'cognome' => $faker->lastName,
        'data_nascita' => $faker->date(),
        'indirizzo' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'telefono_ext' => $faker->phoneNumber,
        'email' => $faker->email,
        'codice_fiscale' => $faker->TaxId,
        'note' => $faker->word,
        'fk_responsabile' => $faker->randomNumber(),
        'image' => $faker->word,
        'fk_associazioni' => $faker->randomNumber(),
        'fk_soci' => $faker->randomNumber(),
        'iban' => $faker->word,
        'banca' => $faker->word,
        'partita_iva' => $faker->word,
        'fk_comuni' => $faker->randomNumber(),
        'fk_comuni_nascita' => $faker->randomNumber(),
        'privacy' => $faker->boolean,
    ];

});
