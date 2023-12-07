<?php

namespace App\Http\Resources\Customer;


use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'address' => $this->address ?? null,
            'description_region' => $this->region->description,
            'description_commune' => $this->commune->description
        ];
    }
}
