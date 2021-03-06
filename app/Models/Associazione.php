<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associazione extends Model
{
    public $timestamps = false; //per Seed err: Column not found: 1054 Unknown column 'updated_at' in 'field list'"
    
    protected $table  = "associazioni";
    
    public function users(){

        return $this->hasMany(Utente::class,'fk_associazioni');
        
    }
            
}
