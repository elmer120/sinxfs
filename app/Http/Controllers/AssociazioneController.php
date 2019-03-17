<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associazione;
use App\Models\Regione;
use App\Models\Provincia;

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


    //ajax
    public function regioni()
    {
        return Regione::all();
    }
    //ajax
    public function province(Request $request)
    {
        
        if(!empty($request->input('region_select')))
        {
            $id_regione = $request->input('region_select');

            return Regione::find($id_regione)->Province;

        }
        else{
            
            return Provincia::all();
        }

    }
    //ajax
    public function comuni(Request $request)
    {
        if(!empty( $request->input('provincia_select')))
        {
            $id_provincia = $request->input('provincia_select');

            return Provincia::find($id_provincia)->Comuni;

        }
        else{
            return "non posso ritorna tutti i comuni";
        }
    }

 
}
