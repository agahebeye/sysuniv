<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class StudentResource extends JsonResource
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
            'registrations' => RegistrationResource::collection($this->whenLoaded('registrations')),
            'photo' => PhotoResource::make($this->whenLoaded('photo')),

            'id' => $this->getRouteKey(),
            'birthDate' => $this->birth_date->format('d/m/Y'),
            $this->merge(Arr::except(parent::toArray($request), ['birth_date'])),
        ];
    }
}
