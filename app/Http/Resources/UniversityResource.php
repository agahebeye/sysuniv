<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UniversityResource extends JsonResource
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
            'id' => $this->getRouteKey(),
            'name' => $this->name,
            'email' => $this->email,
            'website' => $this->website,
            'address' => $this->address,

            'faculties' => UniversityResource::collection($this->whenLoaded('faculties')),
            'institutes' => UniversityResource::collection($this->whenLoaded('institutes')),
            'departments' => UniversityResource::collection($this->whenLoaded('departments')),

            'faculties_count' => $this->when(isset($this->faculties_count), $this->faculties_count),
            'institutes_count' => $this->when(isset($this->institutes_count), $this->institutes_count),
            'students_count' => $this->when(isset($this->students_count), $this->students_count),
        ];
    }
}
