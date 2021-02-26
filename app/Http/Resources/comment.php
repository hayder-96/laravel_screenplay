<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class comment extends JsonResource
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
         'main_screen_id'=>$this->main_screen_id,
         'user_id'=>$this->user_id,
         'parent_id'=>$this->parent_id,
         'descreption'=>$this->descreption,
             'name'=>$this->name,
             'image'=>$this->image,
             'enable'=>$this->enable,
             'created_at'=>$this->created_at->format('d/m/Y'),
    ];
    }
}
