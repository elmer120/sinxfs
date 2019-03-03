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
    Route::prefix('anagrafica')->group(function () {
        Route::get('gestione','AnagraficaController@Gestione')->name('gestione');
        //chiamate ajax
        Route::post('regioni','AnagraficaController@regioni');
        Route::post('province','AnagraficaController@province');
        Route::post('comuni','AnagraficaController@comuni');
        Route::post('sociTipologie','AnagraficaController@sociTipologie');
        Route::post('caricheDirettivo','AnagraficaController@caricheDirettivo');
        Route::post('responsabili','AnagraficaController@responsabili');
        Route::post('create','AnagraficaController@create');

        Route::get('rubrica','AnagraficaController@Rubrica')->name('rubrica');
        Route::get('libro_soci','AnagraficaController@LibroSoci')->name('libro_soci');
    });
    
    Route::prefix('associazione')->group(function () {
        Route::get('dati_associazione','AssociazioneController@DatiAssociazione')->name('dati_associazione');
    });
    
    Route::prefix('contabilita')->group(function () {
        Route::get('dati_associazione','ContabilitaController@index')->name('');
    });
    
    Route::prefix('gestione')->group(function () {
        Route::get('link_rapidi','GestioneController@LinkRapidi')->name('link_rapidi');
        Route::get('utenti','GestioneController@LinkRapidi')->name('utenti');
    });
    
    Route::get('/associazioni','AssociazioneController@index');
    
    
    
    Route::get('/home', 'HomeController@index')->name('home');

});




