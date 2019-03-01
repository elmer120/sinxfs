<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    public $timestamps = false; 
    protected $table  = "utenti";


    /**
     * Get the phone record associated with the user.
     */
    public function associazione()
    {
        //return $this->belongsTo(App\associazione::class,'fk_associazioni');
    }
}
