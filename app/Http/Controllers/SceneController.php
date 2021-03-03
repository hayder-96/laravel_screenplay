<?php

namespace App\Http\Controllers;

use App\Models\scene;
use Illuminate\Http\Request;
use App\Http\Resources\scene as sc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\MainScreen;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class SceneController extends BaseController
{
    


    public function indexo($id)
    {
        $screen=scene::all()->where('main_screen_id',$id);

        return $this->Respone(sc::collection($screen),"Done getData");
        
    }


    

    public function index()
    {
        $screen=scene::all()->where('user_id',Auth::id());

        return $this->Respone(sc::collection($screen),"Done getData");
        
    }

    public function store(Request $request)
    {
        
        $input=$request->all();

        $valdit=Validator::make($request->all(),[

            'numScene'=>'required',
            'nameScene'=>'required',
            'contentScene'=>'required',
            'dialogueScene'=>'required',
            'main_screen_id'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        

    
        
        $user=Auth::user();
        
        $input['user_id']=$user->id;

        $screen=scene::create($input);

        return $this->Respone($screen,'Success input');
        
    }

   





    public function show($id)
    {
        
        $screen=scene::find($id);

        if($screen==null){

            $this->sendError('Failed show');
        }
        
        return $this->Respone(new sc($screen),'Success Show');



    }

    public function update(Request $request,$id)
    {
        $uss=scene::find($id);
        $input=$request->all();

        $valdit=Validator::make($request->all(),[

            'numScene'=>'required',
            'nameScene'=>'required',
            'contentScene'=>'required',
            'dialogueScene'=>'required',
            'main_screen_id'=>'required'
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        
       
        
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError("cant edit this");
        }

        $uss->numScene=$input['numScene'];
        $uss->nameScene=$input['nameScene'];
        $uss->contentScene=$input['contentScene'];
        $uss->dialogueScene=$input['dialogueScene'];
        $uss->main_screen_id=$input['main_screen_id'];
        $uss->user_id=Auth::id();
        $uss->save();

        return $this->Respone(new sc($uss),'Success update');
        
    }

    
    








  
    public function destroy($id)
    {
          $uss=scene::find($id);
          if($uss->user_id!=auth()->user()->id){

            return $this->sendError('canot deleted');
        }
       $uss->delete();
        return $this->Respone(new sc($uss),"done delete");
        }
        
    }
