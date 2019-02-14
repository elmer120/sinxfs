<?php

use Illuminate\Database\Seeder;

class SeedUtenteTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Utente::class,30)->create();
    }
}
