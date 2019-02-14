<?php

use Faker\Generator as Faker;
use App\Models\Comune;
use App\Models\AssociazioneLinks;

$factory->define(App\Models\Associazione::class, function (Faker $faker) {
  
    return [
        'nome' => $faker->company,
        'tipo'  => $faker->companySuffix,
                'anno_fondazione' => $faker->numberBetween(2019,2040),
                'indirizzo'=>  $faker->address,
                'codice_fiscale' =>  $faker->TaxId, //https://github.com/fzaninotto/Faker/tree/master/src/Faker/Provider/it_IT
                'vat' =>  'partita iva in inglese c?',
                'telefono' =>  $faker->phoneNumber,
                'telefono_ext' =>  $faker->phoneNumber,
                'logo' =>  $faker->text(10),
                'email' =>  $faker->email,
                'email_pec' =>  $faker->safeEmail,
                'registration' =>  $faker->randomNumber('8'),
                'partita_iva' =>  $faker->vatId,
                'fk_comuni' => Comune::inRandomOrder()->first()->id,
                'fk_associazioni_links' => AssociazioneLinks::inRandomOrder()->first()->id
    ];
});
