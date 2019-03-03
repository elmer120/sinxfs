<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comune extends Model
{
    protected $table  = "comuni";


    public function Province()
    {
        return $this->belongsTo(Provincia::class,'fk_province');
    }

}
