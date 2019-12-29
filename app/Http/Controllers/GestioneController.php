<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Utente;
use App\Models\UtenteLivello;

class GestioneController extends Controller
{
    
    public function utenti(Request $request)
    {
        /*if(Auth::user()->isAdmin())
        {
            echo 'admin';
        }
        if(Auth::user()->isPowerUser())
        {
            echo 'poweruser';
        }
        if(Auth::user()->isUser())
        {
            echo 'user';
        }
        if(Auth::user()->isGuest())
        {
            echo 'guest';
        }*/
       return view('gestione.utenti',
    [
        'tab_title' => 'Gestione utenti',
        'page_title' => 'Gestione utenti'
    ]);
    }

    //------------------------------------------ AJAX -----------------------------------------
    public function Utente(Request $request)
    {
        if(!empty($request->input('id')) && !empty($request->input('fk_associazioni')))
        {
            $lista = DB::table('utenti')
                            ->where('fk_associazioni',$request->input('fk_associazioni'))
                            ->where('id',$request->input('id'))
                            ->get()->toJson(JSON_PRETTY_PRINT);
            return $lista;
        }
    }

    public function ListaUtenti(Request $request)
    {
        if(!empty($request->input('fk_associazioni')))
        {
            $lista = DB::table('utenti')
                            ->where('fk_associazioni',$request->input('fk_associazioni'))
                            ->get()->toJson(JSON_PRETTY_PRINT);
            return $lista;
        }
    }
    public function LivelliUtenti()
    {
        
            return UtenteLivello::all();

            dd($lista);
        
    }

}
