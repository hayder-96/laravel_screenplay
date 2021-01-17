<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class imageup extends JsonResource
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
         'film_id'=>$this->film_id,
         'image'=>$this->image,
         'title'=>$this->title,
         
    ];
    }
}
