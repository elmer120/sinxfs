<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Provincia extends JsonResource
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
                            "fk_regioni" => $this->fk_regioni,
                            "nome" => $this->nome,
                            "sigla" => $this->sigla
        ];
    }
}
