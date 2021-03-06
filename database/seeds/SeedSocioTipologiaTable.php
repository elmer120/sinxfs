<?php

use Illuminate\Database\Seeder;

class SeedSocioTipologiaTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\SocioTipologia::class,3)->create();

        \DB::table('soci_tipologie')->delete();
        
        \DB::table('soci_tipologie')->insert(array (
                    0 => 
                    array (
                        'id' => 1,
                        'descrizione' => 'direttivo',
                    ),
                    1 => 
                    array (
                        'id' => 2,
                        'descrizione' => 'associato',
                    ),
                    2 => 
                    array (
                        'id' => 3,
                        'descrizione' => 'tesserato',
                    ),
                    3 => 
                    array (
                        'id' => 4,
                        'descrizione' => 'collaboratore',
                    ),
            )
            );
        
    }
}
