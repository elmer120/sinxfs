<?php

use Illuminate\Database\Seeder;
use App\Models\Associazione;

class SeedAssociazioneTable extends Seeder //popola la tabella associazioni
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(App\Models\Associazione::class,3)->create();

        /* METODO MANUALE
        $sql='INSERT INTO associazioni (nome, tipo, anno_fondazione, indirizzo, codice_fiscale, 
        vat, telefono, telefono_ext, logo, email, email_pec, registration, partita_iva)
            VALUES (:nome, :tipo, :anno_fondazione, :indirizzo, :codice_fiscale, :vat, :telefono, :telefono_ext, :logo, :email, :email_pec, :registration, :partita_iva)';
        for ($i=0; $i < 30; $i++) { 
            DB::statement($sql,[
                'nome' => 'rufa'.$i,
                'tipo'  => 'asd'.$i,
                'anno_fondazione' =>'200'.$i,
                'indirizzo'=> 'lesi'.$i,
                'codice_fiscale' => 'PDRMRC'.$i,
                'vat' => '24'.$i,
                'telefono' => '0464'.$i,
                'telefono_ext' => '33893304'.$i,
                'logo' => 'path'.$i,
                'email' => 'prova@gmail.com'.$i,
                'email_pec' => 'pec@gmail.com'.$i,
                'registration' => '123'.$i,
                'partita_iva' => '4543'.$i,
               /* 'fk_comuni' => $i,
                'fk_associazioni_links' => $i
            ]);
            
        }
       */
    }
}
