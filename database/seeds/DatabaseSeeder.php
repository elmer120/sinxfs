<?php

use Illuminate\Database\Seeder;
use App\Models\Associazione;
use App\Models\Utente;
use App\Models\Comune;
use App\Models\Regione;
use App\Models\Provincia;
use App\Models\AssociazioneLinks;

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
        
        AssociazioneLinks::truncate(); //svuolto la tabella
        Associazione::truncate(); //svuolto la tabella
        Utente::truncate(); //svuolto la tabella
        
        Comune::truncate(); //svuolto la tabella
        Provincia::truncate(); //svuolto la tabella
        Regione::truncate(); //svuolto la tabella
       
        $this->call(RegioniTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(ComuniTableSeeder::class);
        
        $this->call(SeedAssociazioneLinksTable::class);
        $this->call(SeedAssociazioneTable::class); //immetto i dati usando la classe SeedAssociazioneTable
        $this->call(SeedUtenteTable::class); 
        $this->call(SeedPersonaTable::class);

       
    }
}
