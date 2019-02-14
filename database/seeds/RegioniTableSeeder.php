<?php

use Illuminate\Database\Seeder;

class RegioniTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('regioni')->delete();
        
        \DB::table('regioni')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Abruzzo',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Basilicata',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Calabria',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Campania',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Emilia-Romagna',
            ),
            5 => 
            array (
                'id' => 6,
                'nome' => 'Friuli-Venezia Giulia',
            ),
            6 => 
            array (
                'id' => 7,
                'nome' => 'Lazio',
            ),
            7 => 
            array (
                'id' => 8,
                'nome' => 'Liguria',
            ),
            8 => 
            array (
                'id' => 9,
                'nome' => 'Lombardia',
            ),
            9 => 
            array (
                'id' => 10,
                'nome' => 'Marche',
            ),
            10 => 
            array (
                'id' => 11,
                'nome' => 'Molise',
            ),
            11 => 
            array (
                'id' => 12,
                'nome' => 'Piemonte',
            ),
            12 => 
            array (
                'id' => 13,
                'nome' => 'Puglia',
            ),
            13 => 
            array (
                'id' => 14,
                'nome' => 'Sardegna',
            ),
            14 => 
            array (
                'id' => 15,
                'nome' => 'Sicilia',
            ),
            15 => 
            array (
                'id' => 16,
                'nome' => 'Toscana',
            ),
            16 => 
            array (
                'id' => 17,
                'nome' => 'Trentino-Alto Adige',
            ),
            17 => 
            array (
                'id' => 18,
                'nome' => 'Umbria',
            ),
            18 => 
            array (
                'id' => 19,
                'nome' => 'Valle d\'Aosta/Vall‚e d\'Aoste',
            ),
            19 => 
            array (
                'id' => 20,
                'nome' => 'Veneto',
            ),
        ));
        
        
    }
}