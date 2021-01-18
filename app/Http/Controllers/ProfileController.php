<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\users;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class ProfileController extends BaseController
{
   



    
    public function indexyes($id)
    {
       
        $users=profile::all()->where('user_id','=',$id)->where('user_id','!=',Auth::id());

       
        return $this->Respone(users::collection($users),'getAll');
    
    }






    
    
    public function index()
    {
       
        $users=profile::all()->where('user_id','=',Auth::id());

       
        return $this->Respone(users::collection($users),'getAll');
    
    }

    public function indexOne()
    {
       
       // $users='profile';
       $users=profile::all()->where('user_id','!=',Auth::id());
        

       
        

        return $this->Respone(users::collection($users),'getOne');
    }

   

    public function store(Request $request)
    {
        $input=$request->all();

        $valdit=Validator::make($request->all(),[
          
            'name'=>'required',
            'age'=>'required',
            'gender'=>'required',
            'country'=>'required'
           
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }


        
      if($request->image!=null){
        
    
       $path= Cloudinary::upload($request->file('image')->getRealPath(),
       array("public_id" =>Auth::id(),"quality"=>'auto'))->getSecurePath();
       
     }










        $user=Auth::user();
        
        $input['user_id']=$user->id;

        if($request->image!=null){
            $input['image']=$path;
           }else{
               $input['image']='https://cdn.pixabay.com/photo/2013/06/17/10/28/end-139848_960_720.jpghttps://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
           }




        $screen=profile::create($input);

        return $this->Respone($screen,'Success input');

    }

    








    
    public function show($id)
    {
        
        $user=profile::find($id);
        if($user==null){

            $this->sendError('Failed show');
        }
        
        return $this->Respone(new users($user),'Success Show');
    }

    
    public function update(Request $request, $id)
    {
        

        $uss=profile::find($id);
        $input=$request->all();

        $valdit=Validator::make($request->all(),[

            'name'=>'required',
            'age'=>'required',
            'country'=>'required'
           
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        
       
        
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError("cant edit this");
        }

        $uss->name=$input['name'];
        $uss->age=$input['age'];
        $uss->country=$input['country'];
        $uss->image=$input['image'];
        $uss->user_id=Auth::id();
        $uss->save();

        return $this->Respone(new users($uss),'Success update');
    }













    
    public function updateimage(Request $request, $id)
    {
        

        $uss=profile::find($id);
        $input=$request->all();

        $valdit=Validator::make($request->all(),[

            'image'=>'required'
           
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        
       
        
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError("cant edit this");
        }

      
        $uss->image=$input['image'];
        $uss->save();

        return $this->Respone(new users($uss),'Success update');
    }







}
