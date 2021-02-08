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
  //  $input['verification_code']=rand(1111,111111);
    $user=User::create($input);
     $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;
     $success['name']=$user->name;
      
     $email=$input['email'];
       $title=$user->verification_code;
            

      
      // Mail::to($email)->send(new signupEmail($title));

    return $resp->Respone($success,'Register ');

}

public function Login(Request $request){

    $resp= new BaseController;

    $user=Auth::user();

    if($user->password!=$request->password){

        return $resp->Respone(500,"password not same");

        return;
    }

      

    $user=User::all()->where('email',$request->email);
    if($user->count()==0){
      return $this->Respone(500,'no');
      return;
    }





    $validit=Validator::make($request->all(),[

        'email'=>'required',
        'password'=>'required',

    ]);
   
    if( Auth::attempt(['email' => $request->email, 'password' => $request->password])){

       
        
        $success['token']=$user->createToken(';ejhih/><{+876yk')->accessToken;

            return $resp->Respone($success,"Login successfully");


    }else{
        return $resp->sendError("Failed Login");
    }  



}



}