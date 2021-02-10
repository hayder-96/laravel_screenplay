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
use Illuminate\Notifications\Notification;
use App\Notifications\notify;
use NexmoMessage as GlobalNexmoMessage;
use Vonage\Voice\NCCO\Action\Notify as ActionNotify;

class forget extends BaseController
{
   

  public function index(){

    // $message=Nexmo::message()->send([

    //   'to' => '7727710118',
    //   'from' => 'Nexmo',
    //   'text' => 'hello laravel',
     
    // ]);
   
    
    $basic  = new \Nexmo\Client\Credentials\Basic('07f43500', 'Wb8LmO6Q81um618U');
$client = new \Nexmo\Client($basic);

$message = $client->message()->send([
    'to' => '9647727710118',
    'from' => 'HAYDER',
    'text' => 'Hi'
]);

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
