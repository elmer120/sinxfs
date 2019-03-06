<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Associazione;
use DB;
use App\Models\Regione;
use App\Models\Provincia;
use App\Models\Comune;
use phpDocumentor\Reflection\Types\This;
use App\Models\SocioTipologia;
use App\Models\CaricaDirettivo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Socio;
use App\Models\SocioCaricaDirettivo;
use App\Models\Tessera;
use PHPUnit\Framework\Error\Error;
class AnagraficaController extends Controller
{
    public function gestione()
    {
        return view('anagrafica.gestione')
            ->with('tab_title',"Gestione anagrafica")
            ->with('page_title' , "Gestione anagrafica");

        //{{ dd(get_defined_vars()['__data']) }} x vedere var passate a view

        //per vedere query in sql standard
        /*DB::enableQueryLog(); //prima della query
        $queries = DB::getQueryLog();
        print_r($queries);*/
    }

    //ajax
    public function getList(Request $request)
    {
        
         $lista = DB::table('persone')
        ->join('comuni', 'persone.fk_comuni', '=', 'comuni.id')
        ->join('province','comuni.fk_province','=','province.id')
        ->join('regioni','province.fk_regioni', '=', 'regioni.id')
        ->leftJoin('soci','persone.fk_soci','=','soci.id')
        ->leftJoin('soci_tipologie','soci.fk_soci_tipologie','=','soci_tipologie.id')
        ->leftJoin('tessere','tessere.fk_soci','=','soci.id')
        ->leftJoin('soci_cariche_direttivo','soci_cariche_direttivo.fk_soci','=','soci.id')
        ->leftJoin('cariche_direttivo','cariche_direttivo.id','=','soci_cariche_direttivo.fk_cariche_direttivo')
        ->select('persone.id','persone.nome','persone.cognome',
        'comuni.nome as comune_nascita',
       // 'comuni.nome as comune_residenza', serve sub-query
        DB::raw('DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita'),
        'soci_tipologie.nome as soci_tipologia',
        'cariche_direttivo.nome as carica_direttivo',
        'tessere.numero as tessera_numero',
        DB::raw('DATE_FORMAT(soci.certificato_scadenza_al, "%d/%m/%Y") as certificato_scadenza_al'),
        DB::raw('DATE_FORMAT(soci.approvazione_data, "%d/%m/%Y") as approvazione_data'),
        DB::raw('DATE_FORMAT(soci.quota_scadenza_al, "%d/%m/%Y") as quota_scadenza')
        )
        ->distinct()
        ->get()->toJson(JSON_PRETTY_PRINT);
        return $lista;
        //dd($lista);
    }

    public function getPerson(Request $request)
    {
        
        if($request->filled('id'))
        {
            $id = $request->input('id');
            $person = DB::table('persone')
            ->join('comuni', 'persone.fk_comuni', '=', 'comuni.id')
            ->join('province','comuni.fk_province','=','province.id')
            ->join('regioni','province.fk_regioni', '=', 'regioni.id')
            ->leftJoin('soci','persone.fk_soci','=','soci.id')
            ->leftJoin('soci_tipologie','soci.fk_soci_tipologie','=','soci_tipologie.id')
            ->leftJoin('tessere','tessere.fk_soci','=','soci.id')
            ->leftJoin('soci_cariche_direttivo','soci_cariche_direttivo.fk_soci','=','soci.id')
            ->leftJoin('cariche_direttivo','cariche_direttivo.id','=','soci_cariche_direttivo.fk_cariche_direttivo')
            ->where('persone.id','=',$id)
            ->select(
            'persone.id',
            'persone.nome',
            'persone.cognome',
            'persone.data_nascita',
            'persone.fk_comuni_nascita',
            'persone.codice_fiscale',
            'persone.partita_iva',
            'comuni.nome as comune_nome',
            'persone.fk_comuni',
            'province.id as province_id',
            'province.nome as province_nome',
            'persone.indirizzo',
            'persone.privacy',
            'persone.telefono',
            'persone.telefono_ext',
            'persone.email',
            'persone.fk_responsabile',
            'persone.iban',
            'persone.banca',
            'persone.note',
            'soci.fk_soci_tipologie',
            'soci.richiesta_data',
            'soci.approvazione_data',
            'soci.scadenza_data',
            'soci.certificato_scadenza_al',
            'soci_cariche_direttivo.fk_cariche_direttivo',
            'soci_cariche_direttivo.carica_direttivo_dal',
            'soci_cariche_direttivo.carica_direttivo_al',
            'tessere.numero',
            'tessere.tessere_dal',
            'tessere.tessere_al',
            'tessere.tessere_tipo'
            )
            ->distinct()
            ->get()->toJson(JSON_PRETTY_PRINT);

            return $person;
        }
        else{
            abort(403,'no id');
        }

    }

    public function create(Request $request)
    {
        //validazione
        $validate_persona = $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'data_nascita' => 'nullable',
            'fk_comuni_nascita' => 'required',
            'codice_fiscale' => 'nullable',
            'partita_iva' => 'nullable',
            'fk_comuni' => 'required',
            'indirizzo' => 'nullable',
            'privacy' => 'nullable',
            'telefono' => 'nullable',
            'telefono_ext' => 'nullable',
            'email' => 'nullable',
            'fk_responsabile' => 'nullable',
            'iban' => 'nullable',
            'banca' => 'nullable',
            'note' => 'nullable'
            //image => ???
        ]);

        if($request->has('socio'))
        {
            $validate_socio = $request->validate([
                'fk_soci_tipologie' => 'required',
                'richiesta_data' => 'required',
                'approvazione_data' => 'required',
                'scadenza_data' => 'required',
                 //quota_scadenza_al
                'certificato_scadenza_al' => 'required'
            ]);
        }

        if($request->has('carica_direttivo'))
        {
            $validate_carica_direttivo = $request->validate([
                'fk_cariche_direttivo' => 'required',
                'carica_direttivo_dal' => 'required',
                'carica_direttivo_al' => 'required'
            ]);
        }
        
        if($request->has('tessere'))
        {
            $validate_tessere = $request->validate([
                'numero' => 'required',
                'tessere_dal' => 'required',
                'tessere_al' => 'required',
                'tessere_tipo'  => 'required'            
            ]);
        }

        //inserimento
        if($request->has('socio'))
        {
            $socio = new Socio([
                'fk_soci_tipologie' => $request->fk_soci_tipologie,
                'richiesta_data' => $request->richiesta_data,
                'approvazione_data' => $request->approvazione_data,
                'scadenza_data' => $request->scadenza_data,
                //quota_scadenza_al
                'certificato_scadenza_al' => $request->certificato_scadenza_al
            ]);
            $socio->save();
        }

        if($request->has('tessere'))
        {
            $tessere = new Tessera([
                'numero' => $request->numero,
                'tessere_dal' => $request->tessere_dal,
                'tessere_al' => $request->tessere_al,
                'tessere_tipo'  => $request->tessere_tipo,
                'fk_soci' => $request->has('socio')? $socio->id : NULL        
            ]);
            $tessere->save();
        }
        
        if($request->has('carica_direttivo'))
        {
            $socio_carica_direttivo = new SocioCaricaDirettivo([
                    'fk_soci' => $request->has('socio')? $socio->id : NULL,
                    'fk_cariche_direttivo' => $request->fk_cariche_direttivo,
                    'carica_direttivo_dal' => $request->carica_direttivo_dal,
                    'carica_direttivo_al' => $request->carica_direttivo_al
                    ]);
            $socio_carica_direttivo->save();
        }

        
        
        $persona = new Persona([
            "nome" => $request->nome,
            "cognome" => $request->cognome,
            "data_nascita" => $request->data_nascita,
            "indirizzo" => $request->indirizzo,
            "telefono" => $request->telefono,
            "telefono_ext" => $request->telefono_ext,
            "email" => $request->email,
            "codice_fiscale" => $request->codice_fiscale,
            "note" => $request->note,
            "fk_responsabile" => $request->fk_responsabile,
            //image => ???
            "fk_associazioni" => Auth::user()->fk_associazioni,
            'fk_soci' => $request->has('socio')? $socio->id : NULL, 
            "iban" => $request->iban,
            "banca" => $request->banca,
            "partita_iva" => $request->partita_iva,
            "fk_comuni" => $request->fk_comuni,
            "fk_comuni_nascita" => $request->fk_comuni_nascita,
            "privacy" => $request->privacy
            ]);

            if($persona->save())
            {
                return "Inserimento avvenuto con successo!";
            }


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
            return Comune::all();
        }
    }

     //ajax
    public function sociTipologie()
    {
        return SocioTipologia::all();
    }

     //ajax
    public function caricheDirettivo()
    {
        return CaricaDirettivo::all();
    }

     //ajax
    public function responsabili()
    {
        
       return  DB::table('persone')
       ->select('id','nome','cognome')
       ->whereRaw("DATEDIFF(CURDATE(),data_nascita)>=6575")->get();
       
        //SELECT persone.id,persone.nome,persone.cognome FROM persone WHERE (DATEDIFF(CURRENT_DATE,persone.data_nascita)) >= '1' ORDER BY persone.nome
    }


    public function Rubrica()
    {
        
    }

    public function LibroSoci()
    {
        
    }
}
