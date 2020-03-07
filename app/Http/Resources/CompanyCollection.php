<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($company) {
                return [
                    'type' => 'company',
                    'id' => $company->id,
                    'attributes' => [
                        'business_name' => $company->business_name,
                        'employees' => $company->n_employees,
                        'ateco' => $company->ateco
                    ],
                    'relationships' => [
                        'type' => $company->type_rel->name,
                        'address' => $company->address_rel->name,
                        'main_field' => $company->main_field_rel
                    ]
                ];
            })
        ];
    }
}
