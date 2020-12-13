<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class scene extends JsonResource
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
         'numScene'=>$this->numScene,
         'nameScene'=>$this->nameScene,
         'main_screen_id'=>$this->main_screen_id,
         'contentScene'=>$this->contentScene,
         'dialogueScene'=>$this->dialogueScene,
         'created_at'=>$this->created_at->format('d/m/Y'),
         'updated_at'=>$this->updated_at->format('d/m/Y'),
    ];
    }
}
