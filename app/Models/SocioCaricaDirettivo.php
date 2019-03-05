<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocioCaricaDirettivo extends Model
{
    protected $table  = "soci_cariche_direttivo";
    public $timestamps = false;

    protected $fillable = array(
        'fk_cariche_direttivo',
        'carica_direttivo_dal',
        'carica_direttivo_al',
        'fk_soci'
    );
}
