<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regione extends Model
{
    protected $table  = "regioni";


    public function Province()
    {
        return $this->hasMany(Provincia::class,'fk_regioni');
    }

}
