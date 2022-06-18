<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
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
            'level' => $this->level,
            'resultStatus' => $this->result_status,
            'university' => UniversityResource::make($this->whenLoaded('university')),
            'faculty' => $this->whenLoaded('faculty'),
            'institute' => $this->whenLoaded('institute'),
            'department' => $this->whenLoaded('department'),
            'result' => $this->whenLoaded('result'),
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
