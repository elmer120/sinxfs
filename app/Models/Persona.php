<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;
    protected $table  = "persone";
    protected $fillable = array (
        'nome',
        'cognome',
        'data_nascita',
        'fk_comuni_nascita',
        'codice_fiscale',
        'partita_iva',
        'fk_comuni',
        'indirizzo' ,
        'privacy' ,
        'telefono',
        'telefono_ext',
        'email',
        'fk_responsabile',
        'iban',
        'banca',
        'note',
        'fk_associazioni',
        'image',
        'fk_soci'
    );
}
