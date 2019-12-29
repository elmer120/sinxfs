<?php

use Illuminate\Database\Seeder;
use App\Models\Utente;
use Carbon\Carbon;

class SeedUtenteTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\Utente::class,5)->create();
        
        \DB::table('utenti')->delete();
        
        \DB::table('utenti')->insert(array (
                    0 => 
                    array (
                        'id' => 1,
                        'nome' => 'nomeAdmin',
                        'username' => 'admin',
                        'password' => bcrypt('admin'),
                        'fk_utenti_livelli' => 1,
                        'immagine' => 'img.jpg',
                        'remember_token' => '',
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                        'ultimo_accesso' => null,
                        'fk_associazioni' => 1,
                    ),
                    1 => 
                    array (
                        'id' => 2,
                        'nome' => 'nomeSuperUser',
                        'username' => 'superuser',
                        'password' => bcrypt('superuser'),
                        'fk_utenti_livelli' => 2,
                        'immagine' => 'img.jpg',
                        'remember_token' => '',
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                        'ultimo_accesso' => null,
                        'fk_associazioni' => 1,
                    ),
                    2 => 
                    array (
                        'id' => 3,
                        'nome' => 'nomeUser',
                        'username' => 'user',
                        'password' => bcrypt('user'),
                        'fk_utenti_livelli' => 3,
                        'immagine' => 'img.jpg',
                        'remember_token' => '',
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                        'ultimo_accesso' => null,
                        'fk_associazioni' => 1,
                    ),
                    3 => 
                    array (
                        'id' => 4,
                        'nome' => 'nomeGuest',
                        'username' => 'guest',
                        'password' => bcrypt('guest'),
                        'fk_utenti_livelli' => 4,
                        'immagine' => 'img.jpg',
                        'remember_token' => '',
                        'created_at' => Carbon::now(),
                        'updated_at' => null,
                        'ultimo_accesso' => null,
                        'fk_associazioni' => 1,
                    ),
            )
            );

    }
}
