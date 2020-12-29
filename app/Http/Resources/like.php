<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class like extends JsonResource
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
         'main_screen_id'=>$this->main_screen_id,
         'name'=>$this->name,
         'country'=>$this->country,
         'image'=>$this->image,
         'boolean'=>$this->boolean
         
         
    ];
    }
}
