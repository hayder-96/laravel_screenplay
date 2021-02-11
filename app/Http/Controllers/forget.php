<?php

namespace App\Http\Controllers;

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
use NexmoMessage as GlobalNexmoMessage;
use Vonage\Voice\NCCO\Action\Notify as ActionNotify;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class forget extends BaseController
{
   

  public function redirectToGoogle()
    {

       
        return Socialite::driver('facebook')->redirect();
    }
   
    public function handleGoogleCallback()
    {
        try {
  
            $user = Socialite::driver('facebook')->user();
   
            $finduser = User::where('email', $user->id)->first();
   
            if($finduser){
   
                Auth::login($finduser);
  
               return redirect('welcome');
   
            }else{
                $newUser = new User;
                    $newUser->name=$user->name;
                    $newUser->email= $user->id;
                    $newUser->password=bcrypt('123456');
                     $newUser->save();
  
                Auth::login($newUser);
   
                return redirect('welcome');
            }
  
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }































  public function index(){

    $message=Socialite::driver('google')->user();
        

    return $this->Respone(200,$message);

  }




    public function store(Request $request){

      $user=User::all()->where('email',$request->email);
      if($user->count()==0){
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
        $input['code']=$co;

        code::create($input);

         $email=$input['email'];

        Mail::to($email)->send(new signupEmail($email,$co));
  

        return $this->Respone('done send',200);

    

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
