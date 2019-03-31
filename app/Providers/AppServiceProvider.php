<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use App\Models\Associazione;
use App\Models\Regione;
use App\Models\Provincia;
use App\Models\Comune;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //x migrazioni su database old
        //errore SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
        Schema::defaultStringLength(191);

        //dati condivisi in tutte le view
        $associazione = Associazione::find(1);
        $comune = Comune::find($associazione->fk_comuni);
        $provincia = Provincia::find($comune);

        $associazione->fk_province = $comune['fk_province'];
        $associazione->fk_regioni = $provincia[0]['fk_regioni'];
        $associazione->comune = $comune['nome'];
        $associazione->provincia = $provincia[0]['nome'];
        $associazione->provincia_sigla = $provincia[0]['sigla'];
        $associazione->cap = $comune['cap'];
        
        
        View::share('associazione',$associazione);
     
       
    }
}
