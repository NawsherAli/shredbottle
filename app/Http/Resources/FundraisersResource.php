<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FundraisersResource extends JsonResource
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
            'id' => $this->id,
            'profile_image' => asset('assets/images/avatars/' . $this->profile_image),
            'name' => $this->fundraiser->company_name,
            'vision_mission' => $this->fundraiser->vision_mission,
            'charity_type' => $this->fundraiser->charity_type,
            'address' => $this->fundraiser->address !== null ? $this->fundraiser->address : 'N/A',
            'goal' => $this->fundraiser->goal !== null ? $this->fundraiser->goal : 0,
            'charity_type' => $this->fundraiser->charity_type,
        ];
    }
}