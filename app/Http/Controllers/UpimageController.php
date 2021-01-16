<?php

namespace App\Http\Controllers;

use App\Models\upimage;
use Illuminate\Http\Request;
 use App\Http\Resources\imageup as upim;
 
 use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class UpimageController extends BaseController
{
  
    public function getim($id)
    {
        
        $screen=upimage::all()->where('film_id',$id);

        return $this->Respone(upim::collection($screen),"Done getData");
        
    
    }

    public function store(Request $request)
    {
        $input=$request->all();
        
      


      if($request->hasFile('image')){
        

        $input['film_id']=$request->film_id;

      //  cloudinary_url("logo.json", array("type"=>"list"));
       
       // cl_image_tag("https://upload.wikimedia.org/wikipedia/commons/1/13/Benedict_Cumberbatch_2011.png", array("type"=>"fetch"));
        

       
      $path= Cloudinary::upload($request->file('image')->getRealPath(), array("public_id" => 'sample_remote'))->getSecurePath();
      $input['image']=$path;
    
    $screen=upimage::create($input);

       

    return $this->Respone($screen,'Success input');
    }
    }

  
    public function destroy($id)
    {
        
        $uss=upimage::find($id);
       
       $uss->delete();
        return $this->Respone(new upim($uss),"done delete");
    }
}
