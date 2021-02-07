<?php

namespace App\Http\Controllers;

use App\Models\code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\signupEmail;
use App\Http\Resources\code as SC;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class CodeController extends BaseController
{
   
    public function getcode($name)
    {
        $users=code::all()->where('email',$name);

       
        return $this->Respone(SC::collection($users),'getAll');
    }

   

   
    public function store(Request $request)
    {
        

        

      $user=User::all()->where('email',$request->email);
      if($user->count()!=0){
        return $this->sendError('هذا الحساب موجود');
        return;
      }


        $input=$request->all();
      
        $valdit=Validator::make($request->all(),[
           
            'email'=>'required',
            
             
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        
        $co=rand(1111,111111);
        $input['code']=$co;

        $code=code::create($input);

         $email=$input['email'];

        Mail::to($email)->send(new signupEmail($email,$co));

       
        
        return $this->Respone($code,'Success input');
    }


     
    public function update(Request $request,$id)
    {
        

        $code=code::find($id);


 $valdit=Validator::make($request->all(),[
           
        
              'email'=>'required'
             
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        $co=rand(1111,111111);
        
      
        $code->code=$co;
        $code->save();
        Mail::to($request->email)->send(new signupEmail($request->email,$co));
        return $this->Respone(new SC($code),'Success update');

    }

   
    public function destroy($id)
    {
        $uss=code::find($id);
      
        $uss->delete();
         return $this->Respone(new sc($uss),"done delete");
    }
}
