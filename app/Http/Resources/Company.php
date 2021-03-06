<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
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
            'type' => 'company',
            'id' => $this->id,
            'attributes' => [
                'business_name' => $this->business_name,
                'employees' => $this->n_employees,
                'ateco' => $this->ateco_rel
            ],
            'relationships' => [
                'type' => $this->type_rel,
                'address' => $this->address_rel,
                'main_field' => $this->main_field_rel,
                'specializations' => $this->specializations,
                'secondary_fields' => $this->fields
            ]
        ];
    }
}
