<?php

namespace App\Http\Controllers;

use App\Mail\signupEmail;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\code;
use Illuminate\Support\Facades\Auth;

class forget extends BaseController
{
   

    public function store(Request $request){






      $user=User::where('email',$request->email);
      if($user==null){
        return $this->Respone('this email dosenot exsist',500);
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


    public function insertpas(Request $request)
    {
        

       
 $valdit=Validator::make($request->all(),[
           
        
              'password'=>'required'
             
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
       

        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);



       
        return $this->Respone($user,'Success update');

    }
    

     
}
