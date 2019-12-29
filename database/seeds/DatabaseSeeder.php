<?php

use Illuminate\Database\Seeder;
use App\Models\Associazione;
use App\Models\Utente;
use App\Models\Comune;
use App\Models\Regione;
use App\Models\Provincia;
use App\Models\AssociazioneLinks;
use App\Models\Persona;
use App\Models\Socio;
use App\Models\SocioTipologia;

class DatabaseSeeder extends Seeder //classe chiamata di default quando si fa php artisan db:seed 
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0'); //Evito il controllo sulle chiavi esterne
        
        AssociazioneLinks::truncate(); //svuoto la tabella
        Associazione::truncate(); //svuoto la tabella
        Utente::truncate(); //svuoto la tabella
        Persona::truncate(); //svuoto la tabella
        Socio::truncate(); //svuoto la tabella
        SocioTipologia::truncate(); //svuoto la tabella
        
        Comune::truncate(); //svuoto la tabella
        Provincia::truncate(); //svuoto la tabella
        Regione::truncate(); //svuoto la tabella
       
        $this->call(RegioniTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(ComuniTableSeeder::class);
        
        $this->call(SeedAssociazioneLinksTable::class);
        $this->call(SeedAssociazioneTable::class); //immetto i dati usando la classe SeedAssociazioneTable
        $this->call(SeedUtenteTable::class); 
        $this->call(SeedUtenteLivelloTable::class); 
        $this->call(SeedSocioTipologiaTable::class);
        $this->call(SeedSocioTable::class);
        $this->call(SeedPersonaTable::class);

       
    }
}
