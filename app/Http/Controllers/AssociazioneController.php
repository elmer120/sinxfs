<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associazione;

class AssociazioneController extends Controller
{
    public function index(Request $request)
    {
      
      
        return Associazione::all('*');
    }

    public function DatiAssociazione(Request $request)
    {
       
        
    }

    public function edit()
    {
        $associazione = Associazione::find(1);

        return view('associazione.dati_associazione') 
                ->with('tab_title',"Dati associazione")
                ->with('page_title' , "Dati associazione");
               // ->with('associazione',$associazione); in app service provider/boot dati condivisi da tutte le view
    }

 
}
