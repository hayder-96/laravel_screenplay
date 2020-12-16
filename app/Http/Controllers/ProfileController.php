<?php

namespace App\Http\Controllers;

use App\Models\profile;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\users;


class ProfileController extends BaseController
{
   


    
    
    public function index()
    {
       
        $users=profile::all();

        return $this->Respone(users::collection($users),'getAll');
    }

    public function indexOne($id)
    {
       
        $users=profile::all()->where('user_id',$id);

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

        $user=Auth::user();
        
        $input['user_id']=$user->id;

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
            'gender'=>'required',
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
        $uss->gender=$input['gender'];
        $uss->country=$input['country'];
        $uss->image=$input['image'];
        $uss->user_id=Auth::id();
        $uss->save();

        return $this->Respone(new users($uss),'Success update');
    }

}
