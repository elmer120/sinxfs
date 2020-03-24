<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\models\SocioTipologia as SocioTipologia;
use App\Http\Resources\SocioTipologia as SocioTipologiaResource;

class Socio extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
       //dd($this);
       return [
        "id" => $this->id,
        "certificato_scadenza_al" => $this->certificato_scadenza_al,
        "richiesta_data" => $this->richiesta_data,
        "approvazione_data" => $this->approvazione_data,
        "quota_scadenza_al" => $this->quota_scadenza_al,
        "scadenza_data" => $this->scadenza_data,
        "tipologia" => new SocioTipologiaResource(SocioTipologia::find($this->fk_soci_tipologie)),
    ];

    }


}
