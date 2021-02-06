<?php

namespace App\Http\Controllers;

use App\Models\code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\signupEmail;
use App\Http\Resources\code as SC;
use Illuminate\Support\Facades\Hash;
class CodeController extends Controller
{
   
    public function getcode($name)
    {
        $users=code::all()->where('email',$name);

       
        return $this->Respone(SC::collection($users),'getAll');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        

        $input=$request->all();
      
        $valdit=Validator::make($request->all(),[
           
            'email'=>'required',
            
             
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        
        $title=rand(1111,111111);
        $input['code']=Hash::make($title);

        $code=code::create($input);

         $email=$input['email'];

        Mail::to($email)->send(new signupEmail($title));

       
        
        return $this->Respone($code,'Success input');
    }



    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        

        $code=code::find($id);


 $valdit=Validator::make($request->all(),[
           
        
              'email'=>'required'
             
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        $title=rand(1111,111111);
        Mail::to($request->email)->send(new signupEmail($title));
      
        $code->code=Hash::make($title);
        $code->save();

        return $this->Respone(new SC($code),'Success update');

    }

   
    public function destroy($id)
    {
        $uss=code::find($id);
      
        $uss->delete();
         return $this->Respone(new sc($uss),"done delete");
    }
}
