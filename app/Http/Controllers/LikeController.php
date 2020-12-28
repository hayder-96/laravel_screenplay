<?php

namespace App\Http\Controllers;

use App\Models\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\like as sc;
use Illuminate\Support\Facades\DB;


class LikeController extends BaseController
{
   
    public function index($id)
    {
        $lik=like::all()->where('main_screen_id',$id);

        return $this->Respone(sc::collection($lik),'Success Show');
    }

    
    public function store(Request $request)
    {
        $input=$request->all();
      
        $valdit=Validator::make($request->all(),[
        'main_screen_id'=>'required',
        'name'=>'required',
        'country'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
     
        $allUsers=like::create($input);
        return $this->Respone($allUsers,'Success input');

    }

    public function getcount($id)
    {
        $lk=like::count()->where('main_screen_id',$id);
        return $this->Respone(sc::collection($lk),'Done get count');
    }

    public function edit(like $like)
    {
        //
    }

    public function update(Request $request, like $like)
    {
        //
    }

    public function destroy($id)
    {
        $uss=like::find($id);
      
        $uss->delete();
         return $this->Respone(new sc($uss),"done delete");
    }
}
