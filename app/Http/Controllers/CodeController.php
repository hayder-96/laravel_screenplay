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
use Illuminate\Support\Facades\Crypt;
class CodeController extends BaseController
{
   
    public function getcode(Request $request)
    {
        $users=code::where('email',$request->email)->first();

        $code=crypt::decrypt($users->code);
        if($code==$request->code){
            
            return $this->Respone(200,'done');

        }
        
     
        return $this->sendError('error');
       
    }



    public function getcoder(Request $request)
    {
        $users=code::where('email',$request->email)->first();

        $code=crypt::decrypt($users->code);
        if($code==$request->code){
            
            return $this->Respone($code,'done');

       }
        
     
        return $this->sendError('error');
       
    }











   

    
    public function getemail($email)
    {
        $users=code::where('email',$email)->first();

            return $this->Respone(SC::collection($users),'done');

        }
   

















    public function store(Request $request)
    {
        

        

      $user=User::all()->where('email',$request->email);
      if($user->count()!=0){
        return $this->Respone(500,'yes');
        return;
      }


        $input=$request->all();
      
        $valdit=Validator::make($request->all(),[
           
            'email'=>'required',
            
             
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        
        $co=rand(10213,98974);
       $op=Crypt::encrypt($co);
       
       $input['code']=$op;
       
      
     
     
        
      code::create($input);

       $email=$input['email'];

       Mail::to($email)->send(new signupEmail($email,$co));

       
        
        return $this->Respone(200,'Success input');
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
        $co=rand(10213,98974);
        
      
        $code->code=$co;
        $code->save();
        Mail::to($request->email)->send(new signupEmail($request->email,$co));
        return $this->Respone('done','Success update');

    }

   
    public function destroy($id)
    {
        $uss=code::find($id);
      
        $uss->delete();
         return $this->Respone(new sc($uss),"done delete");
    }
}
