<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class freind extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
      
       return [
        'id'=>$this->id,
         'user_id'=>$this->user_id,
         'name_id'=>$this->name_id,
         'name'=>$this->name,
         'country'=>$this->country,
         'image'=>$this->image,
         'visibl'=>$this->visibl,
         
    ];
    }
}
