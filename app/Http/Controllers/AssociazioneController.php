<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Associazione;
use DB;

class AssociazioneController extends Controller
{
    public function index(Request $request)
    {
        $sql='SELECT * from associazioni';
        if($request->has('id')){
            $sql .=' where id='.(int)$request->get('id');
        }
       
       // return DB::table('associazioni')->get();
        return Associazione::all('*');
    }
}
