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
       
        return Associazione::all('*');
    }
}
