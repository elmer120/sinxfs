<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('province')->delete();
        
        \DB::table('province')->insert(array (
            0 => 
            array (
                'id' => 1,
                'fk_regioni' => 1,
                'nome' => 'Chieti',
                'sigla' => 'CH',
            ),
            1 => 
            array (
                'id' => 2,
                'fk_regioni' => 1,
                'nome' => 'L\'Aquila',
                'sigla' => 'AQ',
            ),
            2 => 
            array (
                'id' => 3,
                'fk_regioni' => 1,
                'nome' => 'Pescara',
                'sigla' => 'PE',
            ),
            3 => 
            array (
                'id' => 4,
                'fk_regioni' => 1,
                'nome' => 'Teramo',
                'sigla' => 'TE',
            ),
            4 => 
            array (
                'id' => 5,
                'fk_regioni' => 2,
                'nome' => 'Matera',
                'sigla' => 'MT',
            ),
            5 => 
            array (
                'id' => 6,
                'fk_regioni' => 2,
                'nome' => 'Potenza',
                'sigla' => 'PZ',
            ),
            6 => 
            array (
                'id' => 7,
                'fk_regioni' => 3,
                'nome' => 'Catanzaro',
                'sigla' => 'CZ',
            ),
            7 => 
            array (
                'id' => 8,
                'fk_regioni' => 3,
                'nome' => 'Cosenza',
                'sigla' => 'CS',
            ),
            8 => 
            array (
                'id' => 9,
                'fk_regioni' => 3,
                'nome' => 'Crotone',
                'sigla' => 'KR',
            ),
            9 => 
            array (
                'id' => 10,
                'fk_regioni' => 3,
                'nome' => 'Reggio di Calabria',
                'sigla' => 'RC',
            ),
            10 => 
            array (
                'id' => 11,
                'fk_regioni' => 3,
                'nome' => 'Vibo Valentia',
                'sigla' => 'VV',
            ),
            11 => 
            array (
                'id' => 12,
                'fk_regioni' => 4,
                'nome' => 'Avellino',
                'sigla' => 'AV',
            ),
            12 => 
            array (
                'id' => 13,
                'fk_regioni' => 4,
                'nome' => 'Benevento',
                'sigla' => 'BN',
            ),
            13 => 
            array (
                'id' => 14,
                'fk_regioni' => 4,
                'nome' => 'Caserta',
                'sigla' => 'CE',
            ),
            14 => 
            array (
                'id' => 15,
                'fk_regioni' => 4,
                'nome' => 'Napoli',
                'sigla' => 'NA',
            ),
            15 => 
            array (
                'id' => 16,
                'fk_regioni' => 4,
                'nome' => 'Salerno',
                'sigla' => 'SA',
            ),
            16 => 
            array (
                'id' => 17,
                'fk_regioni' => 5,
                'nome' => 'Bologna',
                'sigla' => 'BO',
            ),
            17 => 
            array (
                'id' => 18,
                'fk_regioni' => 5,
                'nome' => 'Ferrara',
                'sigla' => 'FE',
            ),
            18 => 
            array (
                'id' => 19,
                'fk_regioni' => 5,
                'nome' => 'Forl-Cesena',
                'sigla' => 'FC',
            ),
            19 => 
            array (
                'id' => 20,
                'fk_regioni' => 5,
                'nome' => 'Modena',
                'sigla' => 'MO',
            ),
            20 => 
            array (
                'id' => 21,
                'fk_regioni' => 5,
                'nome' => 'Parma',
                'sigla' => 'PR',
            ),
            21 => 
            array (
                'id' => 22,
                'fk_regioni' => 5,
                'nome' => 'Piacenza',
                'sigla' => 'PC',
            ),
            22 => 
            array (
                'id' => 23,
                'fk_regioni' => 5,
                'nome' => 'Ravenna',
                'sigla' => 'RA',
            ),
            23 => 
            array (
                'id' => 24,
                'fk_regioni' => 5,
                'nome' => 'Reggio nell\'Emilia',
                'sigla' => 'RE',
            ),
            24 => 
            array (
                'id' => 25,
                'fk_regioni' => 5,
                'nome' => 'Rimini',
                'sigla' => 'RN',
            ),
            25 => 
            array (
                'id' => 26,
                'fk_regioni' => 6,
                'nome' => 'Gorizia',
                'sigla' => 'GO',
            ),
            26 => 
            array (
                'id' => 27,
                'fk_regioni' => 6,
                'nome' => 'Pordenone',
                'sigla' => 'PN',
            ),
            27 => 
            array (
                'id' => 28,
                'fk_regioni' => 6,
                'nome' => 'Trieste',
                'sigla' => 'TS',
            ),
            28 => 
            array (
                'id' => 29,
                'fk_regioni' => 6,
                'nome' => 'Udine',
                'sigla' => 'UD',
            ),
            29 => 
            array (
                'id' => 30,
                'fk_regioni' => 7,
                'nome' => 'Frosinone',
                'sigla' => 'FR',
            ),
            30 => 
            array (
                'id' => 31,
                'fk_regioni' => 7,
                'nome' => 'Latina',
                'sigla' => 'LT',
            ),
            31 => 
            array (
                'id' => 32,
                'fk_regioni' => 7,
                'nome' => 'Rieti',
                'sigla' => 'RI',
            ),
            32 => 
            array (
                'id' => 33,
                'fk_regioni' => 7,
                'nome' => 'Roma',
                'sigla' => 'RM',
            ),
            33 => 
            array (
                'id' => 34,
                'fk_regioni' => 7,
                'nome' => 'Viterbo',
                'sigla' => 'VT',
            ),
            34 => 
            array (
                'id' => 35,
                'fk_regioni' => 8,
                'nome' => 'Genova',
                'sigla' => 'GE',
            ),
            35 => 
            array (
                'id' => 36,
                'fk_regioni' => 8,
                'nome' => 'Imperia',
                'sigla' => 'IM',
            ),
            36 => 
            array (
                'id' => 37,
                'fk_regioni' => 8,
                'nome' => 'La Spezia',
                'sigla' => 'SP',
            ),
            37 => 
            array (
                'id' => 38,
                'fk_regioni' => 8,
                'nome' => 'Savona',
                'sigla' => 'SV',
            ),
            38 => 
            array (
                'id' => 39,
                'fk_regioni' => 9,
                'nome' => 'Bergamo',
                'sigla' => 'BG',
            ),
            39 => 
            array (
                'id' => 40,
                'fk_regioni' => 9,
                'nome' => 'Brescia',
                'sigla' => 'BS',
            ),
            40 => 
            array (
                'id' => 41,
                'fk_regioni' => 9,
                'nome' => 'Como',
                'sigla' => 'CO',
            ),
            41 => 
            array (
                'id' => 42,
                'fk_regioni' => 9,
                'nome' => 'Cremona',
                'sigla' => 'CR',
            ),
            42 => 
            array (
                'id' => 43,
                'fk_regioni' => 9,
                'nome' => 'Lecco',
                'sigla' => 'LC',
            ),
            43 => 
            array (
                'id' => 44,
                'fk_regioni' => 9,
                'nome' => 'Lodi',
                'sigla' => 'LO',
            ),
            44 => 
            array (
                'id' => 45,
                'fk_regioni' => 9,
                'nome' => 'Mantova',
                'sigla' => 'MN',
            ),
            45 => 
            array (
                'id' => 46,
                'fk_regioni' => 9,
                'nome' => 'Milano',
                'sigla' => 'MI',
            ),
            46 => 
            array (
                'id' => 47,
                'fk_regioni' => 9,
                'nome' => 'Monza e della Brianza',
                'sigla' => 'MB',
            ),
            47 => 
            array (
                'id' => 48,
                'fk_regioni' => 9,
                'nome' => 'Pavia',
                'sigla' => 'PV',
            ),
            48 => 
            array (
                'id' => 49,
                'fk_regioni' => 9,
                'nome' => 'Sondrio',
                'sigla' => 'SO',
            ),
            49 => 
            array (
                'id' => 50,
                'fk_regioni' => 9,
                'nome' => 'Varese',
                'sigla' => 'VA',
            ),
            50 => 
            array (
                'id' => 51,
                'fk_regioni' => 10,
                'nome' => 'Ancona',
                'sigla' => 'AN',
            ),
            51 => 
            array (
                'id' => 52,
                'fk_regioni' => 10,
                'nome' => 'Ascoli Piceno',
                'sigla' => 'AP',
            ),
            52 => 
            array (
                'id' => 53,
                'fk_regioni' => 10,
                'nome' => 'Fermo',
                'sigla' => 'FM',
            ),
            53 => 
            array (
                'id' => 54,
                'fk_regioni' => 10,
                'nome' => 'Macerata',
                'sigla' => 'MC',
            ),
            54 => 
            array (
                'id' => 55,
                'fk_regioni' => 10,
                'nome' => 'Pesaro e Urbino',
                'sigla' => 'PU',
            ),
            55 => 
            array (
                'id' => 56,
                'fk_regioni' => 11,
                'nome' => 'Campobasso',
                'sigla' => 'CB',
            ),
            56 => 
            array (
                'id' => 57,
                'fk_regioni' => 11,
                'nome' => 'Isernia',
                'sigla' => 'IS',
            ),
            57 => 
            array (
                'id' => 58,
                'fk_regioni' => 12,
                'nome' => 'Alessandria',
                'sigla' => 'AL',
            ),
            58 => 
            array (
                'id' => 59,
                'fk_regioni' => 12,
                'nome' => 'Asti',
                'sigla' => 'AT',
            ),
            59 => 
            array (
                'id' => 60,
                'fk_regioni' => 12,
                'nome' => 'Biella',
                'sigla' => 'BI',
            ),
            60 => 
            array (
                'id' => 61,
                'fk_regioni' => 12,
                'nome' => 'Cuneo',
                'sigla' => 'CN',
            ),
            61 => 
            array (
                'id' => 62,
                'fk_regioni' => 12,
                'nome' => 'Novara',
                'sigla' => 'NO',
            ),
            62 => 
            array (
                'id' => 63,
                'fk_regioni' => 12,
                'nome' => 'Torino',
                'sigla' => 'TO',
            ),
            63 => 
            array (
                'id' => 64,
                'fk_regioni' => 12,
                'nome' => 'Verbano-Cusio-Ossola',
                'sigla' => 'VB',
            ),
            64 => 
            array (
                'id' => 65,
                'fk_regioni' => 12,
                'nome' => 'Vercelli',
                'sigla' => 'VC',
            ),
            65 => 
            array (
                'id' => 66,
                'fk_regioni' => 13,
                'nome' => 'Bari',
                'sigla' => 'BA',
            ),
            66 => 
            array (
                'id' => 67,
                'fk_regioni' => 13,
                'nome' => 'Barletta-Andria-Trani',
                'sigla' => 'BT',
            ),
            67 => 
            array (
                'id' => 68,
                'fk_regioni' => 13,
                'nome' => 'Brindisi',
                'sigla' => 'BR',
            ),
            68 => 
            array (
                'id' => 69,
                'fk_regioni' => 13,
                'nome' => 'Foggia',
                'sigla' => 'FG',
            ),
            69 => 
            array (
                'id' => 70,
                'fk_regioni' => 13,
                'nome' => 'Lecce',
                'sigla' => 'LE',
            ),
            70 => 
            array (
                'id' => 71,
                'fk_regioni' => 13,
                'nome' => 'Taranto',
                'sigla' => 'TA',
            ),
            71 => 
            array (
                'id' => 72,
                'fk_regioni' => 14,
                'nome' => 'Cagliari',
                'sigla' => 'CA',
            ),
            72 => 
            array (
                'id' => 73,
                'fk_regioni' => 14,
                'nome' => 'Carbonia-Iglesias',
                'sigla' => 'CI',
            ),
            73 => 
            array (
                'id' => 74,
                'fk_regioni' => 14,
                'nome' => 'Medio Campidano',
                'sigla' => 'VS',
            ),
            74 => 
            array (
                'id' => 75,
                'fk_regioni' => 14,
                'nome' => 'Nuoro',
                'sigla' => 'NU',
            ),
            75 => 
            array (
                'id' => 76,
                'fk_regioni' => 14,
                'nome' => 'Ogliastra',
                'sigla' => 'OG',
            ),
            76 => 
            array (
                'id' => 77,
                'fk_regioni' => 14,
                'nome' => 'Olbia-Tempio',
                'sigla' => 'OT',
            ),
            77 => 
            array (
                'id' => 78,
                'fk_regioni' => 14,
                'nome' => 'Oristano',
                'sigla' => 'OR',
            ),
            78 => 
            array (
                'id' => 79,
                'fk_regioni' => 14,
                'nome' => 'Sassari',
                'sigla' => 'SS',
            ),
            79 => 
            array (
                'id' => 80,
                'fk_regioni' => 15,
                'nome' => 'Agrigento',
                'sigla' => 'AG',
            ),
            80 => 
            array (
                'id' => 81,
                'fk_regioni' => 15,
                'nome' => 'Caltanissetta',
                'sigla' => 'CL',
            ),
            81 => 
            array (
                'id' => 82,
                'fk_regioni' => 15,
                'nome' => 'Catania',
                'sigla' => 'CT',
            ),
            82 => 
            array (
                'id' => 83,
                'fk_regioni' => 15,
                'nome' => 'Enna',
                'sigla' => 'EN',
            ),
            83 => 
            array (
                'id' => 84,
                'fk_regioni' => 15,
                'nome' => 'Messina',
                'sigla' => 'ME',
            ),
            84 => 
            array (
                'id' => 85,
                'fk_regioni' => 15,
                'nome' => 'Palermo',
                'sigla' => 'PA',
            ),
            85 => 
            array (
                'id' => 86,
                'fk_regioni' => 15,
                'nome' => 'Ragusa',
                'sigla' => 'RG',
            ),
            86 => 
            array (
                'id' => 87,
                'fk_regioni' => 15,
                'nome' => 'Siracusa',
                'sigla' => 'SR',
            ),
            87 => 
            array (
                'id' => 88,
                'fk_regioni' => 15,
                'nome' => 'Trapani',
                'sigla' => 'TP',
            ),
            88 => 
            array (
                'id' => 89,
                'fk_regioni' => 16,
                'nome' => 'Arezzo',
                'sigla' => 'AR',
            ),
            89 => 
            array (
                'id' => 90,
                'fk_regioni' => 16,
                'nome' => 'Firenze',
                'sigla' => 'FI',
            ),
            90 => 
            array (
                'id' => 91,
                'fk_regioni' => 16,
                'nome' => 'Grosseto',
                'sigla' => 'GR',
            ),
            91 => 
            array (
                'id' => 92,
                'fk_regioni' => 16,
                'nome' => 'Livorno',
                'sigla' => 'LI',
            ),
            92 => 
            array (
                'id' => 93,
                'fk_regioni' => 16,
                'nome' => 'Lucca',
                'sigla' => 'LU',
            ),
            93 => 
            array (
                'id' => 94,
                'fk_regioni' => 16,
                'nome' => 'Massa-Carrara',
                'sigla' => 'MS',
            ),
            94 => 
            array (
                'id' => 95,
                'fk_regioni' => 16,
                'nome' => 'Pisa',
                'sigla' => 'PI',
            ),
            95 => 
            array (
                'id' => 96,
                'fk_regioni' => 16,
                'nome' => 'Pistoia',
                'sigla' => 'PT',
            ),
            96 => 
            array (
                'id' => 97,
                'fk_regioni' => 16,
                'nome' => 'Prato',
                'sigla' => 'PO',
            ),
            97 => 
            array (
                'id' => 98,
                'fk_regioni' => 16,
                'nome' => 'Siena',
                'sigla' => 'SI',
            ),
            98 => 
            array (
                'id' => 99,
                'fk_regioni' => 17,
                'nome' => 'Bolzano/Bozen',
                'sigla' => 'BZ',
            ),
            99 => 
            array (
                'id' => 100,
                'fk_regioni' => 17,
                'nome' => 'Trento',
                'sigla' => 'TN',
            ),
            100 => 
            array (
                'id' => 101,
                'fk_regioni' => 18,
                'nome' => 'Perugia',
                'sigla' => 'PG',
            ),
            101 => 
            array (
                'id' => 102,
                'fk_regioni' => 18,
                'nome' => 'Terni',
                'sigla' => 'TR',
            ),
            102 => 
            array (
                'id' => 103,
                'fk_regioni' => 19,
                'nome' => 'Valle d\'Aosta/Vall‚e d\'Aoste',
                'sigla' => 'AO',
            ),
            103 => 
            array (
                'id' => 104,
                'fk_regioni' => 20,
                'nome' => 'Belluno',
                'sigla' => 'BL',
            ),
            104 => 
            array (
                'id' => 105,
                'fk_regioni' => 20,
                'nome' => 'Padova',
                'sigla' => 'PD',
            ),
            105 => 
            array (
                'id' => 106,
                'fk_regioni' => 20,
                'nome' => 'Rovigo',
                'sigla' => 'RO',
            ),
            106 => 
            array (
                'id' => 107,
                'fk_regioni' => 20,
                'nome' => 'Treviso',
                'sigla' => 'TV',
            ),
            107 => 
            array (
                'id' => 108,
                'fk_regioni' => 20,
                'nome' => 'Venezia',
                'sigla' => 'VE',
            ),
            108 => 
            array (
                'id' => 109,
                'fk_regioni' => 20,
                'nome' => 'Verona',
                'sigla' => 'VR',
            ),
            109 => 
            array (
                'id' => 110,
                'fk_regioni' => 20,
                'nome' => 'Vicenza',
                'sigla' => 'VI',
            ),
        ));
        
        
    }
}