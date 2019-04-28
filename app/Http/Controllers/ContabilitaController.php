<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Fondo;
use App\Models\Ricevuta;
use App\Models\Pagamento;
use App\Models\Movimento;
use App\Models\VoceContoEconomico;
use DB;

class ContabilitaController extends Controller
{
    //
    public function Ricevuta()
    {
        return view('contabilita.ricevuta')
        ->with('tab_title',"Ricevuta")
        ->with('page_title' , "Ricevuta");
    }

    //ajax
    public function persone()
    {
        return Persona::all();
    }

}
