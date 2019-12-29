<?php

use Illuminate\Database\Seeder;

class SeedUtenteLivelloTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('utenti_livelli')->delete();
        
        \DB::table('utenti_livelli')->insert(array (
                    0 => 
                    array (
                        'id' => 1,
                        'descrizione' => 'admin',
                    ),
                    1 => 
                    array (
                        'id' => 2,
                        'descrizione' => 'superuser',
                    ),
                    2 => 
                    array (
                        'id' => 3,
                        'descrizione' => 'user',
                    ),
                    3 => 
                    array (
                        'id' => 4,
                        'descrizione' => 'guest',
                    ),
            )
            );
    }
}
