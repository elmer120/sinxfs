<?php

use Faker\Generator as Faker;
use App\Models\Comune;
use App\Models\Associazione;
use App\Models\Socio;

$factory->define(App\Models\Persona::class, function (Faker $faker) {
   
    
    return [
        'nome' => $faker->firstName,
        'cognome' => $faker->lastName,
        'data_nascita' => $faker->date(),
        'indirizzo' => $faker->streetAddress,
        'telefono' => $faker->phoneNumber,
        'telefono_ext' => $faker->phoneNumber,
        'email' => $faker->email,
        'codice_fiscale' => $faker->TaxId,
        'note' => $faker->text(30),
        'fk_responsabile' => $faker->randomNumber(),
        'image' => $faker->word,
        'fk_associazioni' => Associazione::inRandomOrder()->first()->id,
        'fk_soci' => Socio::inRandomOrder()->first()->id,
        'iban' => $faker->iban('IT'),
        'banca' => $faker->word,
        'partita_iva' => $faker->vatId,
        'fk_comuni' => Comune::inRandomOrder()->first()->id,
        'fk_comuni_nascita' => Comune::inRandomOrder()->first()->id,
        'privacy' => $faker->boolean
    ];

});
