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

Route::get('/','DashboardController@Home')->name('dashboard');

Route::group(['middleware->auth'],function(){

    Route::prefix('anagrafica')->group(function () {
        Route::get('gestione','AnagraficaController@Gestione')->name('gestione');
        Route::get('rubrica','AnagraficaController@Rubrica')->name('rubrica');
        Route::get('libro_soci','AnagraficaController@LibroSoci')->name('libro_soci');
    });

});

Route::prefix('associazione')->group(function () {
    Route::get('dati_associazione','AssociazioneController@DatiAssociazione')->name('dati_associazione')->middleware('auth');
});

Route::prefix('contabilita')->group(function () {
    Route::get('dati_associazione','ContabilitaController@index')->name('');
});
Route::prefix('gestione')->group(function () {
    Route::get('link_rapidi','GestioneController@LinkRapidi')->name('');
});

Route::get('/associazioni','AssociazioneController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


