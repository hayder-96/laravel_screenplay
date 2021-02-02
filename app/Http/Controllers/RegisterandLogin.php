<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Mail\signupEmail;
use Illuminate\Support\Facades\Mail;
use Mailgun\Mailgun;
class RegisterandLogin extends Controller{

    


    public function getmail(){

        Mail::to('ha679552@gmail.com')->send(new signupEmail('HELLO'));
     
    }




    public function Register(Request $request){
    $resp= new BaseController;

    $validit=Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required',
        'password'=>'required',
        'c_password'=>'required|same:password',

    ]);
    if($validit->fails()){

        return $resp->sendError('failed register!',$validit->errors());
    }

    $input=$request->all();

    $input['password']= Hash::make($input['password']);
    // $input['verification_code']=sha1(time());
    $user=User::create($input);
    // $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;
    // $success['name']=$user->name;
     
    $email=$input['email'];
      $title="thank you";

      
    Mail::to($email)->send(new signupEmail($title));

    return $resp->Respone($user,'Register ');

}

public function Login(Request $request){

    $resp= new BaseController;

    $validit=Validator::make($request->all(),[

        'email'=>'required',
        'password'=>'required',

    ]);
   
    if( Auth::attempt(['email' => $request->email, 'password' => $request->password])){

        $user=Auth::user();

        $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;

            return $resp->Respone($success,"Login successfully");


    }else{
        return $resp->sendError("Failed Login");
    }  



}



}