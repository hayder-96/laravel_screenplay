<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\message as sc;
class MessageController extends BaseController
{
   
    public function index()
    {
        $user=message::all()->where('user_id',Auth::id());

        return $this->Respone(sc::collection($user),'Success Show');

    }

   
    public function store(Request $request)
    {
      
        
        $input=$request->all();

        $valdit=Validator::make($request->all(),[
        'name_id'=>'required',
        'name'=>'required'
        
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        $user=Auth::user();
        $input['user_id']=$user->id;
        $allUsers=message::create($input);
        return $this->Respone($allUsers,'Success input');

    }



    public function getMessage()
    {
     
        
        $user=message::all()->where('name_id','=',Auth::id(),'AND','visibl','!=','نعم');
        return $this->Respone(sc::collection($user),'Success Show');
    }

    

    public function update(Request $request,$id)
    {
        

        $uss=message::find($id);
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




    public function destroy(message $message)
    {
        //
    }

}