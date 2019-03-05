<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tessera extends Model
{
    protected $table  = "tessere";
    public $timestamps = false;
    protected $fillable = array(
    'numero',
    'tessere_dal',
    'tessere_al',
    'tessere_tipo',      
    'fk_soci',
    );
}
