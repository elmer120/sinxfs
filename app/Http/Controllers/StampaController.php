<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StampaController extends Controller
{
  
    
    //ajax
    //ritorna lista ordinata per stampa librosoci
    public function getListLibroSoci(){
        $lista = DB::table('persone')
        ->join('comuni', 'persone.fk_comuni', '=', 'comuni.id')
        ->join('province','comuni.fk_province','=','province.id')
        ->join('regioni','province.fk_regioni', '=', 'regioni.id')
        ->leftJoin('soci','persone.fk_soci','=','soci.id')
        ->leftJoin('soci_tipologie','soci.fk_soci_tipologie','=','soci_tipologie.id')
        ->leftJoin('tessere','tessere.fk_soci','=','soci.id')
        ->leftJoin('soci_cariche_direttivo','soci_cariche_direttivo.fk_soci','=','soci.id')
        ->leftJoin('cariche_direttivo','cariche_direttivo.id','=','soci_cariche_direttivo.fk_cariche_direttivo')
        ->select(   
                    'persone.id','tessere.numero as tessera_numero',
                    'persone.nome','persone.cognome','persone.indirizzo',
                    DB::raw('DATE_FORMAT(persone.data_nascita, "%d/%m/%Y") as data_nascita'),
                    //comune nascita
                    DB::raw("(SELECT DISTINCT comuni.nome 
                    FROM regioni 
                    INNER JOIN province 
                    on province.fk_regioni = regioni.id
                    INNER JOIN comuni
                    on comuni.fk_province = province.id
                    WHERE comuni.id = persone.fk_comuni_nascita) as comune_nascita"),

                    'comuni.nome as comune_residenza','province.sigla as provincia_sigla_residenza','persone.codice_fiscale',
                    'persone.email','persone.telefono',
                    DB::raw('DATE_FORMAT(soci.approvazione_data, "%d/%m/%Y") as socio_approvazione_data'),'soci_tipologie.descrizione as soci_tipologia','cariche_direttivo.nome as carica_direttivo'
        )
        ->distinct()
        ->get()
        ->toJson(JSON_PRETTY_PRINT);
        
        return $lista;
        
    }
}
