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
class AnagraficaController extends Controller
{
    public function gestione()
    {

        $lista = DB::table('persone')
        ->join('comuni', 'persone.fk_comuni', '=', 'comuni.id')
        ->join('province','comuni.fk_province','=','province.id')
        ->join('regioni','province.fk_regioni', '=', 'regioni.id')
        ->leftJoin('soci','persone.fk_soci','=','soci.id')
        ->leftJoin('soci_tipologie','soci.fk_soci_tipologie','=','soci.id')
        ->leftJoin('tessere','tessere.fk_soci','=','soci.id')
        ->leftJoin('soci_cariche_direttivo','soci_cariche_direttivo.fk_soci','=','soci.id')
        ->leftJoin('cariche_direttivo','cariche_direttivo.id','=','soci_cariche_direttivo.fk_cariche_direttivo')

        //->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('persone.id','persone.nome','persone.cognome',
        'comuni.nome as comune_nascita',
        DB::raw('DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita'),
        'soci_tipologie.nome as soci_tipologia',
        'cariche_direttivo.nome as carica_direttivo',
        'tessere.numero as tessera_numero',
        DB::raw('DATE_FORMAT(soci.certificato_scadenza_al, "%d/%m/%Y") as certificato_scadenza_al'),
        DB::raw('DATE_FORMAT(soci.approvazione_data, "%d/%m/%Y") as approvazione_data'),
        DB::raw('DATE_FORMAT(soci.quota_scadenza_al, "%d/%m/%Y") as quota_scadenza')
        
        )
        ->distinct()->get();
        
        //dd($lista);
        
        /*
        $sql = 'SELECT DISTINCT
        persone.id,
        persone.nome,
        persone.cognome,
        persone.fk_comuni_nascita as comune_nascita,
        comuni.nome as comune_residenza,
        DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita,
        soci_tipologie.nome as soci_tipologia,
        cariche_direttivo.nome as carica_direttivo,
        tessere.numero as tessera_numero,
        DATE_FORMAT(soci.certificato_scadenza_al, "%d/%m/%Y") as certificato_scadenza_al,
        DATE_FORMAT(soci.approvazione_data, "%d/%m/%Y") as approvazione_data,
        DATE_FORMAT(soci.quota_scadenza_al, "%d/%m/%Y") as quota_scadenza

        FROM   persone INNER JOIN comuni
        ON     persone.fk_comuni = comuni.id
        INNER JOIN province
        ON comuni.fk_province = province.id
        INNER JOIN regioni
        ON province.fk_regioni = regioni.id
        LEFT JOIN soci
        ON persone.fk_soci = soci.id
        LEFT JOIN soci_tipologie
        ON soci.fk_soci_tipologie = soci.id
        LEFT JOIN tessere
        ON tessere.fk_soci = soci.id
        LEFT JOIN soci_cariche_direttivo
        ON soci_cariche_direttivo.fk_soci = soci.id
        LEFT JOIN cariche_direttivo
        ON cariche_direttivo.id = soci_cariche_direttivo.fk_cariche_direttivo
        ORDER BY persone.nome';
        $lista = DB::select($sql);
return $lista;*/
      
        return view('anagrafica.gestione')
            ->with('tab_title',"Gestione anagrafica")
            ->with('page_title' , "Gestione anagrafica")
            ->with('lista',$lista,true);

        //{{ dd(get_defined_vars()['__data']) }} x vedere var passate a view
    }

    public function create(Request $request)
    {
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
        ]);

        if($request->has('socio'))
        {
            $validate_socio = $request->validate([
                'fk_soci_tipologie' => 'required',
                'richiesta_data' => 'required',
                'approvazione_data' => 'required',
                'scadenza_data' => 'required',
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
        
        
       
        
        
    }

    public function regioni()
    {
        return Regione::all();
    }
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

    public function sociTipologie()
    {
        return SocioTipologia::all();
    }

    public function caricheDirettivo()
    {
        return CaricaDirettivo::all();
    }

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
