<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Socio as SocioResource;
use App\Http\Resources\Associazione as AssociazioneResource;
use App\Http\Resources\Comune as ComuneResource;
use App\Http\Resources\Provincia as ProvinciaResource;
use App\Http\Resources\Regione as RegioneResource;
use App\Models\Comune as Comune;
use App\Models\Provincia as Provincia;
use App\Models\Regione as Regione;
use App\Models\Socio as Socio;
use App\Models\Associazione as Associazione;


class Persona extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
//dd( Regione::find((Provincia::find( Comune::find($this->fk_comuni)->fk_province))->fk_regioni)
//);
        return [
            "persona" => [
                "id" => $this->id,
                "nome"=> $this->nome,
                "cognome" => $this->cognome,
                "data_nascita" => $this->data_nascita,
                "indirizzo" => $this->indirizzo,
                "telefono" => $this->telefono,
                "telefono_ext" => $this->telefono_ext,
                "email" => $this->email,
                "codice_fiscale" => $this->codice_fiscale,
                "note" => $this->note,
                "fk_responsabile" => $this->fk_responsabile,
                "image" => $this->image,
                "associazione" => new AssociazioneResource(Associazione::find($this->fk_associazioni)),
                "socio" => new SocioResource(Socio::find($this->fk_soci)),
                "iban" => $this->iban,
                "banca" => $this->banca,
                "partita_iva" => $this->partita_iva,
                "residenza" => [ 
                                "comune" => new ComuneResource(Comune::find($this->fk_comuni)),
                                "provincia" => new ProvinciaResource((Provincia::find(Comune::find($this->fk_comuni)->fk_province))),
                                "regione" => new RegioneResource( Regione::find((Provincia::find( Comune::find($this->fk_comuni)->fk_province))->fk_regioni) ),
                            ],
                "luogo_nascita" => [ 
                                "comune" => new ComuneResource(Comune::find($this->fk_comuni_nascita)),
                                "provincia" => new ProvinciaResource((Provincia::find(Comune::find($this->fk_comuni_nascita)->fk_province))),
                                "regione" => new RegioneResource( Regione::find((Provincia::find( Comune::find($this->fk_comuni_nascita)->fk_province))->fk_regioni) ),
                ],
                "fk_comuni_nascita" => 1966,
                "privacy" => $this->privacy
            ],
        ];
    }
}
