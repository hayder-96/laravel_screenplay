<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class forget extends BaseController
{
   
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $input = $request->only('email');
    $validator = Validator::make($input, [
        'email' => "required|email"
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors());
    }
    $response = Password::sendResetLink($input);

    $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : 'GLOBAL_SOMETHING_WANTS_TO_WRONG';
    
        

        return $this->Respone('Password has been successfully changed',200);
    }
    

    

     

    

  
    public function resetpassword(ResetPassword $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
