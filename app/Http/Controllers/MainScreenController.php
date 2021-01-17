<?php

namespace App\Http\Controllers;

use App\Models\MainScreen;
use Illuminate\Http\Request;
use App\Http\Resources\screen as sc;
use Cloudinary\Cloudinary as CloudinaryCloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
        
        
       
        
       // $photo->move('uploads.posts',$newphoto);
             
      //$path=(new UploadApi())->upload($newphoto);

      // $path=cloudinary()->upload($request->file($photo)->getRealPath())->getSecurePath();
      $path= Cloudinary::upload($request->file('image')->getRealPath(),
      array("public_id" =>$request->title), array("transformation"=>array(
        array("width"=>600, "crop"=>"scale"),
        array("quality"=>"auto"))))->getSecurePath();
      
    }
       
      // $newphoto=time().$path->getClientOriginalName();
      // $path=Storage::put('uploads.posts/',$newphoto);
     // $fileName = $request->file('file')->getClientOriginalName();
        
   // $pa=cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        

   //Cloudinary::destroy('my_image', array("invalidate" => TRUE));



   

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

      
        if($request->image!=null){

            Cloudinary::destroy($uss->title, array("invalidate" => TRUE));
           
            $uss->image=$request->image;
    //     Cloudinary::delete($po);
    //     $poo=$request->image;
    //     $path= Cloudinary::upload($poo->getRealPath())->getSecurePath();
    //     $uss->image=$path;
    //    }else{
    //     $uss->image=$request->image;
        }
   
    // $poo=$request->file('image');
    
    //  $image_name=  Cloudinary::update($poo->getRealPath())->getSecurePath();
     

     
       
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
        Cloudinary::destroy($uss->title);
        Cloudinary::destroy($uss->title, array("invalidate" => TRUE));
       $uss->delete();
        return $this->Respone(new sc($uss),"done delete");
        }




    




    }

