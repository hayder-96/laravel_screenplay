<?php

namespace App\Http\Controllers;

use App\Models\MainScreen;
use Illuminate\Http\Request;
use App\Http\Resources\screen as sc;
use App\Http\Resources\screen;
use App\Models\profile;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\UploadedFile;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MainScreenController extends BaseController
{
   




    public function getProfile($id)
    {
        $screen=MainScreen::where('user_id',$id)->get();

        return $this->Respone(sc::collection($screen),"Done getData");
        
    }




    public function index()
    {
        $screen=MainScreen::where('user_id',Auth::id())->get();

        return $this->Respone(sc::collection($screen),"Done getData");
        
    }

    public function store(Request $request)
    {

        $input=$request->all();
        
        $valdit=Validator::make($request->all(),[
          
            'title'=>'required',
           
           
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }



      if($request->image!=null){
        

       $photo=$request->file('image');
        
       
        
       // $photo->move('uploads.posts',$newphoto);
             
      //$path=(new UploadApi())->upload($newphoto);

      // $path=cloudinary()->upload($request->file($photo)->getRealPath())->getSecurePath();
      $path= Cloudinary::upload($photo->getRealPath())->getSecurePath();
    }
       //dd($photo);
      // $newphoto=time().$path->getClientOriginalName();
      // $path=Storage::put('uploads.posts/',$newphoto);
     // $fileName = $request->file('file')->getClientOriginalName();
        
   // $pa=cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        
   

        $user=Auth::user();
        
        $input['user_id']=$user->id;

        if($request->image!=null){
         $input['image']=$path;
        }else{
            $input['image']='https://cdn.pixabay.com/photo/2013/06/17/10/28/end-139848_960_720.jpg';
        }
       
        $screen=MainScreen::create($input);

       

        return $this->Respone($screen,'Success input');
        
    }

   





    public function show($id)
    {
        
        $screen=MainScreen::find($id);

        if($screen==null){

            $this->sendError('Failed show');
        }
        
        return $this->Respone(new sc($screen),'Success Show');



    }

    public function update(Request $request,$id)
    {
        $uss=MainScreen::find($id);
        $input=$request->all();

        $valdit=Validator::make($request->all(),[
           
            'title'=>'required',
           // 'image'=>'required'
        ]);

      

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError("cant edit this");
        }


    //    $po=Cloudinary::find($uss->image);

      
    //    if($po!=$request->image){

    //     Cloudinary::delete($po);
    //     $poo=$request->image;
    //     $path= Cloudinary::upload($poo->getRealPath())->getSecurePath();
    //     $uss->image=$path;
    //    }else{
    //     $uss->image=$request->image;
    //    }
   
    
     //$image_name=  Cloudinary::update($poo->getRealPath())->getSecurePath();
     

     if($request->has('image')){
         $poo=$request->file('image');
            $path= Cloudinary::upload($poo->getRealPath())->getSecurePath();
            $uss->image=$path;
        }
       
      //  $po=$path;
        $uss->title=$input['title'];
        $uss->user_id=Auth::id();
        $uss->save();

        return $this->Respone(new sc($uss),'Success update');
        
    }

    

  
    public function destroy($id)
    {
          $uss=MainScreen::find($id);
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError('canot deleted');
        }
       $uss->delete();
        return $this->Respone(new sc($uss),"done delete");
        }




        public function storeimage(Request $request){



            $uploadFolder = 'users';
            $image = $request->file('image');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $uploadedImageResponse = array(
               "image_name" => basename($image_uploaded_path),
               "image_url" => Storage::disk('public'),
               "mime" => $image->getClientMimeType()
            );
            return $this->Respone($uploadedImageResponse,'File Uploaded Successfully');
           }





        }
        
    






