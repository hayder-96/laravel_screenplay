<?php

namespace App\Http\Controllers;

use App\Http\Resources\users;
use App\Mail\signupEmail;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;
use App\Models\code;
use Exception;
use Illuminate\Notifications\Notification;
use App\Notifications\notify;
use Facebook\Facebook;
use NexmoMessage as GlobalNexmoMessage;
use Vonage\Voice\NCCO\Action\Notify as ActionNotify;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
class forget extends BaseController
{
   
   
    public function store(Request $request){

      $user=User::where('email',$request->email)->first();
      if($user==null){
        return $this->Respone(500,'no');
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

      // Mail::to($email)->send(new signupEmail($email,$co));
  
        $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;

        return $this->Respone($success,200);
   
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



       
        return $this->Respone('Success update',200);

    }
    

     
}
