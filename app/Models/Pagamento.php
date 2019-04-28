<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $table  = "pagamenti";
    public $timestamps = false;

    protected $fillable = array(
        'al',
        'fk_fatture',
        'fk_fondi',
        'fk_ricevute',
        'fk_persone'
    );
}
