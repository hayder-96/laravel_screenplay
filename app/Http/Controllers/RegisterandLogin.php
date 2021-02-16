<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;


class RegisterandLogin extends Controller{

    


    public function Register(Request $request){
    $resp= new BaseController;

    $validit=Validator::make($request->all(),[

        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required',
        'c_password'=>'required|same:password',

    ]);
    if($validit->fails()){

        return $resp->sendError('failed register!',$validit->errors());
    }

    $input=$request->all();


    

    $input['password']= Hash::make($input['password']);
   
    $user=User::create($input);
     $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;
     $success['name']=$user->name;
      

    return $resp->Respone($success,'تم التسجيل ');

}

public function Login(Request $request){

    $resp= new BaseController;

   

    $validit=Validator::make($request->all(),[

        'email'=>'required|email',
        'password'=>'required',

    ]);
   
    if( Auth::attempt(['email' => $request->email, 'password' => $request->password])){

        $user=Auth::user();

         
        $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;

            return $resp->Respone($success,"تم الدخول");


    }else{
        return $resp->Respone(500,"البريد  او الرمز غير متطابق");
    }  



}









public function LoginFacebook(Request $request){

    $resp= new BaseController;

   

    $validit=Validator::make($request->all(),[

      
        'password'=>'required'

    ]);
   
   



    if( Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user=Auth::user();

         
        $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;

            return $resp->Respone($success,"تم الدخول");


    }else{

        $input=$request->all();


    

        $input['password']= Hash::make($input['password']);
       
        $user=User::create($input);
         $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;
         $success['name']=$user->name;
          


        return $resp->Respone($success,200);
    }  



}


















}