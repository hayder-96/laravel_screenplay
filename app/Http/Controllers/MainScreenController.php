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
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\UploadedFile;
use Cloudinary\Api\Upload;
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


        $photo=$request->image;
        $newphoto=time().$photo->getClientOriginalName();
       // $photo->move('uploads.posts',$newphoto);

      $path=(new UploadApi())->upload($newphoto);

      // $path=Cloudinary::upload($newphoto)->getRealPath()->getSecurePath();
         
      // $path=Storage::put('uploads.posts/',$newphoto);



        
        $user=Auth::user();
        
        $input['user_id']=$user->id;
         $input['image']=$path;

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
            'image'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError("cant edit this");
        }

        $uss->title=$input['title'];
        $uss->image=$input['image'];
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
        
    






