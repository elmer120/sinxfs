<?php
/*
$factory->define(App\Models\Associazione::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
        'tipo' => $faker->word,
        'anno_fondazione' => $faker->randomNumber(),
        'indirizzo' => $faker->word,
        'codice_fiscale' => $faker->word,
        'vat' => $faker->word,
        'telefono' => $faker->word,
        'telefono_ext' => $faker->word,
        'logo' => $faker->word,
        'email' => $faker->safeEmail,
        'email_pec' => $faker->word,
        'registration' => $faker->word,
        'partita_iva' => $faker->word,
        'fk_comuni' => $faker->randomNumber(),
        'fk_associazioni_links' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\AssociazioneLinks::class, function (Faker\Generator $faker) {
    return [
        'web_site' => $faker->word,
        'web_mail' => $faker->word,
        'web_mail_pec' => $faker->word,
        'facebook' => $faker->word,
        'instagram' => $faker->word,
        'youtube' => $faker->word,
        'twitter' => $faker->word,
        'home_banking' => $faker->word,
    ];
});

$factory->define(App\Models\CaricaDirettivo::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
    ];
});

$factory->define(App\Models\Comune::class, function (Faker\Generator $faker) {
    return [
        'fk_province' => $faker->randomNumber(),
        'nome' => $faker->word,
        'cap' => $faker->word,
    ];
});

$factory->define(App\Models\ContoEconomico::class, function (Faker\Generator $faker) {
    return [
        'anno' => $faker->randomNumber(),
        'saldo' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\Fattura::class, function (Faker\Generator $faker) {
    return [
        'numero' => $faker->word,
        'data' => $faker->date(),
        'scadenza_al' => $faker->date(),
        'importo' => $faker->randomFloat(),
        'fk_persone' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\FatturaDettaglio::class, function (Faker\Generator $faker) {
    return [
        'descrizione' => $faker->word,
        'quantita' => $faker->randomNumber(),
        'prezzo_unitario' => $faker->randomFloat(),
        'iva' => $faker->randomFloat(),
        'fk_fatture' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\Fondo::class, function (Faker\Generator $faker) {
    return [
        'numero' => $faker->word,
        'descrizione' => $faker->word,
        'tipo' => $faker->word,
        'iban' => $faker->word,
        'saldo' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\Movimento::class, function (Faker\Generator $faker) {
    return [
        'data' => $faker->date(),
        'causale' => $faker->word,
        'importo' => $faker->randomFloat(),
        'tipo' => $faker->word,
        'fk_pagamenti' => $faker->randomNumber(),
        'fk_fondi' => $faker->randomNumber(),
        'fk_prime_note' => $faker->randomNumber(),
        'fk_voci_conto_economico' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\Pagamento::class, function (Faker\Generator $faker) {
    return [
        'al' => $faker->date(),
        'fk_fatture' => $faker->randomNumber(),
        'fk_fondi' => $faker->randomNumber(),
        'fk_ricevute' => $faker->randomNumber(),
        'fk_persone' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\Persona::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
        'cognome' => $faker->word,
        'data_nascita' => $faker->date(),
        'indirizzo' => $faker->word,
        'telefono' => $faker->word,
        'telefono_ext' => $faker->word,
        'email' => $faker->safeEmail,
        'codice_fiscale' => $faker->word,
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

$factory->define(App\Models\PrimaNota::class, function (Faker\Generator $faker) {
    return [
        'anno' => $faker->randomNumber(),
        'saldo' => $faker->randomFloat(),
    ];
});

$factory->define(App\Models\Provincia::class, function (Faker\Generator $faker) {
    return [
        'fk_regioni' => $faker->randomNumber(),
        'nome' => $faker->word,
        'sigla' => $faker->word,
    ];
});

$factory->define(App\Models\Regione::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
    ];
});

$factory->define(App\Models\Ricevuta::class, function (Faker\Generator $faker) {
    return [
        'numero' => $faker->randomNumber(),
        'data' => $faker->date(),
        'importo' => $faker->randomFloat(),
        'fk_persone' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\Socio::class, function (Faker\Generator $faker) {
    return [
        'certificato_scadenza_al' => $faker->date(),
        'richiesta_data' => $faker->date(),
        'approvazione_data' => $faker->date(),
        'quota_scadenza_al' => $faker->date(),
        'scadenza_data' => $faker->date(),
        'fk_soci_tipologie' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\SocioCaricaDirettivo::class, function (Faker\Generator $faker) {
    return [
        'fk_soci' => $faker->randomNumber(),
        'fk_cariche_direttivo' => $faker->randomNumber(),
        'carica_direttivo_dal' => $faker->date(),
        'carica_direttivo_al' => $faker->date(),
    ];
});

$factory->define(App\Models\SocioTipologia::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
    ];
});

$factory->define(App\Models\Tessera::class, function (Faker\Generator $faker) {
    return [
        'numero' => $faker->word,
        'tessere_dal' => $faker->date(),
        'tessere_tipo' => $faker->word,
        'tessere_al' => $faker->date(),
        'fk_soci' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'email_verified_at' => $faker->dateTimeBetween(),
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Utente::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->word,
        'password' => bcrypt($faker->password),
        'immagine' => $faker->word,
        'email' => $faker->safeEmail,
        'livello' => $faker->randomNumber(),
        'creato_al' => $faker->dateTimeBetween(),
        'aggiornato_al' => $faker->dateTimeBetween(),
        'remember_token' => str_random(10),
        'ultimo_accesso' => $faker->dateTimeBetween(),
        'fk_associazioni' => $faker->randomNumber(),
    ];
});

$factory->define(App\Models\VoceContoEconomico::class, function (Faker\Generator $faker) {
    return [
        'descrizione' => $faker->word,
        'tipo' => $faker->word,
        'importo' => $faker->randomFloat(),
        'fk_conti_economici' => $faker->randomNumber(),
    ];
});*/

