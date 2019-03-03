<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table  = "province";


    public function Comuni()
    {
        return $this->hasMany(Comune::class,'fk_province');
    }
}
