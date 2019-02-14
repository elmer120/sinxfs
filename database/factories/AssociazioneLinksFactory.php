<?php

use Faker\Generator as Faker;


$factory->define(App\Models\AssociazioneLinks::class, function (Faker $faker) {
  
    return [
        'web_site' => $faker->url,
        'web_mail'  => $faker->url,
        'web_mail_pec' => $faker->url,
        'facebook'=>  $faker->url,
        'instagram' =>  $faker->url,
        'youtube' =>  $faker->url,
        'twitter' => $faker->url,
        'home_banking' =>  $faker->url,
                							
    ];
});
