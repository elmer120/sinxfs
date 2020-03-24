<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\models\provincia as Provincia;
use App\Http\Resources\Provincia as ProvinciaResource;

class Comune extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "cap" => $this->cap,
            "fk_province" => $this->fk_province
        ];
    }
}
