<?php

use App\Models\Associazione;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// https://github.com/alexeymezenin/laravel-best-practices#follow-laravel-naming-conventions

Auth::routes();


Route::group(['middleware' => ['auth']],function(){

    Route::get('/','DashboardController@Home')->name('dashboard');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    //------------ ANAGRAFICA ---------------------------
    Route::prefix('anagrafica')->group(function () {
        //pagine
        Route::get('gestione','AnagraficaController@Gestione')->name('gestione');
        Route::get('libro_soci','AnagraficaController@LibroSoci')->name('libro_soci');
        Route::get('rubrica','AnagraficaController@Rubrica')->name('rubrica');

        //chiamate ajax
        Route::post('regioni','AnagraficaController@regioni');
        Route::post('province','AnagraficaController@province');
        Route::post('comuni','AnagraficaController@comuni');
        Route::post('sociTipologie','AnagraficaController@sociTipologie');
        Route::post('caricheDirettivo','AnagraficaController@caricheDirettivo');
        Route::post('responsabili','AnagraficaController@responsabili');
        Route::post('create','AnagraficaController@create');
        Route::put('create','AnagraficaController@create');
        Route::delete('deletePerson','AnagraficaController@deletePerson');
        Route::post('getList','AnagraficaController@getList')->name('getListAnagrafica');
        Route::post('getPerson','AnagraficaController@getPerson')->name('getPerson');
        Route::get('getPerson','AnagraficaController@getPerson')->name('getPerson');

        Route::post('getListRubrica','AnagraficaController@getListRubrica')->name('getListRubrica');
        
        
    });
    //------------ STAMPA ---------------------------
    Route::prefix('stampa')->group(function () {
        
        //chiamate ajax
        Route::post('getListLibroSoci','StampaController@getListLibroSoci')->name('getListLibroSoci');
    });
    
    Route::prefix('associazione')->group(function () {
        Route::get('dati_associazione','AssociazioneController@edit')->name('dati_associazione');
         //chiamate ajax
        Route::post('regioni','AssociazioneController@regioni');
        Route::post('province','AssociazioneController@province');
        Route::post('comuni','AssociazioneController@comuni');

    });
    
    Route::prefix('contabilita')->group(function () {
    
        Route::get('ricevuta','RicevutaController@ricevuta')->name('ricevuta');
        Route::get('fattura','fatturaController@fattura')->name('fattura');

        //chiamate ajax ricevuta
        Route::post('getList','RicevutaController@getList')->name('getList');
        Route::post('persone','RicevutaController@persone');
        Route::post('fondi','RicevutaController@fondi');
        Route::post('vociContoEconomico','RicevutaController@vociContoEconomico');
        Route::post('numero','RicevutaController@numero');
        Route::post('create','RicevutaController@create');
        Route::put('update','RicevutaController@update');
        Route::delete('delete','RicevutaController@delete');
        Route::post('get','RicevutaController@get');
        
    });
    
    Route::prefix('gestione')->group(function () {
        Route::get('link_rapidi','GestioneController@LinkRapidi')->name('link_rapidi');
        Route::get('utenti','GestioneController@LinkRapidi')->name('utenti');
    });
    
    Route::get('/associazioni','AssociazioneController@index');
    
    
    
    Route::get('/home', 'HomeController@index')->name('home');

});




