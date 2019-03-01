<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Associazione;
use DB;
class AnagraficaController extends Controller
{
    public function Gestione()
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

    public function Rubrica()
    {
        
    }

    public function LibroSoci()
    {
        
    }
}
