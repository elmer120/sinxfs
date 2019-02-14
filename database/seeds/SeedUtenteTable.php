<?php

use Illuminate\Database\Seeder;
use App\Models\Utente;

class SeedUtenteTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Utente::class,5)->create();
    }
}
