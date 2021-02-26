<?php

namespace App\Http\Controllers;

use App\Models\friend as fr;
use Illuminate\Http\Request;
 use App\Http\Resources\freind as sc;
use App\Http\Resources\freind;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Auth;

class FriendController extends BaseController
{
    
    public function index()
    {
        

        $user=fr::all()->where('user_id',Auth::id())->where('visibl','yes');

        return $this->Respone(sc::collection($user),'Success Show');


    }


    public function indexname($id)
    {
        

        $user=fr::all()->where('name_id',Auth::id())->where('visibl','yes')->where('user_id',$id);

        if($user->count()!=0){
        return $this->Respone(200,'yes');
        
        }else{
            return $this->Respone(200,'no'); 
        }

    }














    public function store(Request $request)
    {
        
        $input=$request->all();
     
        $valdit=Validator::make($request->all(),[
            'id'=>'required',
        'name_id'=>'required',
        'country'=>'required',
        'name'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        $user=Auth::user();
        $input['user_id']=$user->id;
        $allUsers=fr::create($input);
        return $this->Respone($allUsers,'Success input');

    }






    public function input(Request $request)
    {
        
        $input=$request->all();
     
        $valdit=Validator::make($request->all(),[
            'id'=>'required',
        'user_id'=>'required',
        'country'=>'required',
        'name'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        $user=Auth::user();
        $input['name_id']=$user->id;
        $allUsers=fr::create($input);
        return $this->Respone($allUsers,'Success input');

    }






   
    public function show($id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $uss=fr::find($id);
        $input=$request->all();

        $valdit=Validator::make($request->all(),[

            'visibl'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
     
        $uss->visibl=$input['visibl'];
        $uss->save();

        return $this->Respone(new sc($uss),'Success update');
        
    }

    

   
    public function destroy($id)
    {
        $uss=fr::find($id);
      
       $uss->delete();
        return $this->Respone(new sc($uss),"done delete");
        }


        public function getItem($id){

            $user=fr::all()->where('name_id',Auth::id())->where('user_id',$id);

            return $this->Respone( sc::collection($user),"done getItem");

        }
    }

