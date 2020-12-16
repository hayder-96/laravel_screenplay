<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class users extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);

      return [
        'id'=>$this->id,
        'name'=>$this->name,
        'age'=>$this->age,
        'image'=>$this->image,
        'gender'=>$this->gender,
        'country'=>$this->country,
        'user_id'=>$this->user_id
    ];
}
    }

