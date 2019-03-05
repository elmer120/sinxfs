<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    public $timestamps = false;
    protected $table  = "soci";
    protected $fillable = array(
        'fk_soci_tipologie',
        'richiesta_data',
        'approvazione_data',
        'scadenza_data',
        //quota_scadenza_al
        'certificato_scadenza_al'
    );
}
