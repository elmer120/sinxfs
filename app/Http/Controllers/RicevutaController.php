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

class RicevutaController extends Controller
{
    //
    public function Ricevuta()
    {
        return view('contabilita.ricevuta')
        ->with('tab_title',"Ricevuta")
        ->with('page_title' , "Ricevuta");
    }

    //ajax
    public function create(Request $request)
    {
        //se è un inserimento
        if($request->isMethod('POST') )
        {
           // data_pagamento=2019-04-17&fondo=1&voce_conto_economico=1
           
            $ricevuta_values = [
                "numero" => $request->numero,
                "data" => $request->data_emissione,
                "importo" => $request->importo,
                "fk_persone" => $request->persona,
                "causale" => $request->causale
            ];
            
            $ricevuta = new Ricevuta($ricevuta_values);

            if($ricevuta->save())
            {
                $pagamento_values = [
                    "al" => $request->data_pagamento,
                    "fk_fondi" => $request->fondo,
                    "fk_persone" => $request->persona,
                    "fk_ricevute" => $ricevuta->id,
                ];
                $pagamento = new Pagamento($pagamento_values);
                if($pagamento->save())
                {
                    $movimento_values = [
                        "data" => $request->data_pagamento,
                        "causale" => $request->causale,
                        "importo" => $request->importo,
                        "tipo" => 'e',
                        "fk_pagamenti" => $pagamento->id,
                        "fk_fondi" => $request->fondo,
                        "fk_prime_note" => 0,
                        "fk_voci_conto_economico" => $request->voce_conto_economico,
                    ];
                    $movimento = new Movimento($movimento_values);
                    if($movimento->save())
                    {
                        return "Inserimento avvenuto con successo!";
                    }
                }

            }
        }
    }

    public function update(Request $request)
    {
         //se è un aggiornamento
         if($request->isMethod('PUT') )
         {
            // data_pagamento=2019-04-17&fondo=1&voce_conto_economico=1
            //recupero la ricevuta
            $ricevuta_id = $request->id;
            $ricevuta = Ricevuta::find($ricevuta_id);
            //aggiorno il model
            $ricevuta->numero = $request->numero; 
            $ricevuta->data = $request->data_emissione; 
            $ricevuta->importo = $request->importo;
            $ricevuta->fk_persone = $request->persona;
            $ricevuta->causale = $request->causale;
                //salvo
                if($ricevuta->save())
                {
                   
                    //recupero il pagamento
                    $pagamento = Pagamento::where('fk_ricevute',$ricevuta_id)->first();
                    //aggiorno il model
                    $pagamento->al =  $request->data_pagamento;
                    $pagamento->fk_fondi =  $request->fondo;
                    $pagamento->fk_persone =  $request->persona;
                        //salvo
                        if($pagamento->save())
                        {
                            //recupero il movimento
                            $movimento = Movimento::where('fk_pagamenti',$pagamento->id)->first();
                            //aggiorno il model
                            $movimento->data = $request->data_pagamento;
                            $movimento->causale = $request->causale;
                            $movimento->importo = $request->importo;
                            $movimento->tipo = 'e';
                            $movimento->fk_pagamenti = $pagamento->id;
                            $movimento->fk_fondi = $request->fondo;
                            $movimento->fk_prime_note = 0;
                            $movimento->fk_voci_conto_economico =$request->voce_conto_economico;
                            //salvo
                            if($movimento->save())
                            {
                                return "Aggiornamento avvenuto con successo";
                            }

                        }
                }
                return "Errore nel aggiornare il database";
            }
    }

    public function delete(Request $request)
    {
        
        if($request->filled('id'))
        {
            $id=$request->input('id');
            $ricevuta = Ricevuta::find($id);
            if($ricevuta->delete()) //on cascade delete!
            {
                return "Eliminazione effettuata";
            }
        }
        else{
            return "Errore nel eliminazione!";
        }
    }

    //ajax
    public function getList()
    {
         $lista = DB::table('ricevute')
        ->join('persone', 'ricevute.fk_persone', '=', 'persone.id')
        ->join('pagamenti','pagamenti.fk_ricevute','=','ricevute.id')
        ->join('fondi','pagamenti.fk_fondi', '=', 'fondi.id')
        ->join('movimenti','movimenti.fk_voci_conto_economico', '=', 'fondi.id')
        ->join('voci_conto_economico','voci_conto_economico.id', '=','movimenti.fk_voci_conto_economico')
        ->select('ricevute.id','ricevute.numero','ricevute.data','ricevute.importo','persone.nome as persona_nome','ricevute.causale as ricevuta_causale',
                DB::raw('DATE_FORMAT(pagamenti.al, "%d/%m/%Y") as pagamento_data'),'fondi.descrizione as fondo_descrizione','voci_conto_economico.descrizione as voce_conto_economico_descrizione')
        ->distinct()
        ->get()->toJson(JSON_PRETTY_PRINT);
        return $lista;
        //dd($lista);
    }
    
    //ajax
    public function get(Request $request)
    {
        if($request->filled('id'))
        {
            $id = $request->input('id');
            $ricevuta = DB::table('ricevute')
            ->join('persone', 'ricevute.fk_persone', '=', 'persone.id')
            ->join('pagamenti','pagamenti.fk_ricevute','=','ricevute.id')
            ->join('fondi','pagamenti.fk_fondi', '=', 'fondi.id')
            ->join('movimenti','movimenti.fk_voci_conto_economico', '=', 'fondi.id')
            ->join('voci_conto_economico','voci_conto_economico.id', '=','movimenti.fk_voci_conto_economico')
            ->where('ricevute.id','=',$id)
            ->select('ricevute.id','ricevute.numero','ricevute.data','ricevute.importo','persone.id as fk_persona','ricevute.causale as ricevuta_causale',
                    'pagamenti.al as pagamento_data','fondi.id as fk_fondo',
                    'voci_conto_economico.id as fk_voce_conto_economico')
            ->distinct()
            ->get()->toJson(JSON_PRETTY_PRINT);
            return $ricevuta;
        }
        else{
            abort(403,'no id');
        }
    }

    //ajax
    public function persone()
    {
        return Persona::all();
    }

    //ajax
    public function fondi()
    {
        return Fondo::all();
    }
    //ajax
    public function vociContoEconomico()
    {
        return VoceContoEconomico::all();
    }
    //ajax
    public function numero(){
        return DB::table('ricevute')->max('numero')+1;
    }

}
