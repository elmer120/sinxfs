<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ricevuta extends Model
{
    protected $table  = "ricevute";
    public $timestamps = false;

    protected $fillable = array(
        'numero',
        'data',
        'importo',
        'fk_persone',
        'causale'
    );
}
