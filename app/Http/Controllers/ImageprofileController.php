<?php

namespace App\Http\Controllers;

use App\Models\imageprofile;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\imageprofile as im;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class ImageprofileController extends BaseController
{
   
    public function index()
    {
        
        $user=imageprofile::all()->where('user_id',Auth::id());

        return $this->Respone(im::collection($user),"Done");



    }

    
    public function store(Request $request)
    {
        $input=$request->all();
        
       

       // if($request->hasFile('image')){
          
  
          $user=Auth::user();

          $input['user_id']=$user->id;
          
         
      //  $path= Cloudinary::upload($request->file('image')->getRealPath(), array("public_id" =>Auth::id()))->getSecurePath();
      //   $input['image']=$path;
      
   //  $screen=imageprofile::create($input);
  
         
  
      return $this->Respone($input['user_id'],'Success input');
     // }
    }



    public function destroy($id)
    {
        
        $uss=imageprofile::find($id);
       
       $uss->delete();
        return $this->Respone(new im($uss),"done delete");
    }
}