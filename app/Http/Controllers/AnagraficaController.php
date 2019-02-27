<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use DB;
class AnagraficaController extends Controller
{
    public function Gestione()
    {
        /*$sql = 'SELECT DISTINCT
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
        INNER JOIN soci_tipologie
        ON soci.fk_soci_tipologie = soci.id
        LEFT JOIN tessere
        ON tessere.fk_soci = soci.id
        LEFT JOIN soci_cariche_direttivo
        ON soci_cariche_direttivo.fk_soci = soci.id
        LEFT JOIN cariche_direttivo
        ON cariche_direttivo.id = soci_cariche_direttivo.fk_cariche_direttivo
        ORDER BY persone.nome"';
        return DB::select($sql);*/

        return view('anagrafica.gestione',[
        'tab_title' => 'Gestione anagrafica',
        'page_title' => 'Gestione anagrafica']);
    }

    public function Rubrica()
    {
        
    }

    public function LibroSoci()
    {
        
    }
}
