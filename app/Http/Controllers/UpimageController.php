<?php

namespace App\Http\Controllers;

use App\Models\upimage;
use Illuminate\Http\Request;
 use App\Http\Resources\imageup as upim;
 use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class UpimageController extends BaseController
{
  
    public function index($id)
    {
        
        $screen=upimage::all()->where('film_id',$id);

        return $this->Respone(upim::collection($screen),"Done getData");
        
    
    }

    public function store(Request $request)
    {
        $input=$request->all();
        
      


      if($request->image!=null){
        

       $photo=$request->file('image');
        
       
      $path= Cloudinary::upload($photo->getRealPath())->getSecurePath();
      $input['image']=$path;
    $input['film_id']=$request->film_id;
    $screen=upimage::create($input);

       

    return $this->Respone($screen,'Success input');
    }
    }

  
    public function destroy($id)
    {
        
        $uss=upimage::find($id);
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError('canot deleted');
        }
       $uss->delete();
        return $this->Respone(new upim($uss),"done delete");
    }
}
