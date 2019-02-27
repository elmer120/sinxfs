<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Home(Request $request)
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
       return view('dashboard',
    [
        'tab_title' => 'Dashboard',
        'page_title' => 'Dashboard'
    ]);
    }
}
