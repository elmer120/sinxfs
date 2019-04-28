<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimento extends Model
{
    protected $table  = "movimenti";
    public $timestamps = false;

    protected $fillable = array(
        'data',
        'causale',
        'importo',
        'tipo',
        'fk_pagamenti',
        'fk_fondi',
        'fk_prime_note',
        'fk_voci_conto_economico'
    );
}
