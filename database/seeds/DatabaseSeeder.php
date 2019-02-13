<?php

use Illuminate\Database\Seeder;
use App\Models\Associazione;

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
        
        Associazione::truncate(); //svuolto la tabella
        
        $this->call(SeedAssociazioneTable::class); //immetto i dati usando la classe SeedAssociazioneTable
    }
}
