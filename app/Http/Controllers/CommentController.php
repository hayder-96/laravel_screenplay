<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
 use Illuminate\Support\Facades\Auth;
 use App\Http\Resources\comment as sc;
class CommentController extends BaseController
{
   
    public function indexx($id)
    {
        
        $com=comment::all()->where('main_screen_id',$id)->where('parent_id',null);
        return $this->Respone(SC::collection($com),'success input');
    }


    public function indexcom($id)
    {
        
        $com=comment::all()->where('parent_id',$id);
        return $this->Respone(SC::collection($com),'success input');
    }


    
    public function index()
    {
        
        $com=comment::all()->where('user_id',Auth::id());
        return $this->Respone(SC::collection($com),'success input');
    }




    public function store(Request $request)
    {
        
        $input=$request->all();
      
        $valdit=Validator::make($request->all(),[
           
            'descreption'=>'required',
              'name'=>'required',
              'image'=>'required',
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }
        $user=Auth::user();
        $input['user_id']=$user->id;
        $allUsers=comment::create($input);
        return $this->Respone($allUsers,'Success input');
    }

   
    public function destroy($id)
    {

        $uss=comment::find($id);
      
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError('canot deleted');
        }
        $uss->delete();
         return $this->Respone(new sc($uss),"done delete");
        
    }




    public function show($id)
    {
        
        $screen=comment::find($id);

        if($screen==null){

            $this->sendError('Failed show');
        }
        
        return $this->Respone(new sc($screen),'Success Show');

    }
    
    public function update(Request $request,$id)
    {
        $uss=comment::find($id);
        $input=$request->all();

        $valdit=Validator::make($request->all(),[

            'descreption'=>'required'
            
        ]);

        if($valdit->fails()){

            return $this->sendError('Failed input',$valdit->errors());
        }

        
        if($uss->user_id!=auth()->user()->id){

            return $this->sendError("cant edit this");
        }

        $uss->descreption=$input['descreption'];
        $uss->user_id=Auth::id();
        $uss->save();

        return $this->Respone(new sc($uss),'Success update');
        
    }


















    public function updateenable(Request $request,$id)
    {
        $uss=comment::find($id);
        $input=$request->all();

    //     $valdit=Validator::make($request->all(),[

    //         'enable'=>'required'
            
    //     ]);

    //     if($valdit->fails()){

    //         return $this->sendError('Failed input',$valdit->errors());
    //     }

    //     if($uss->user_id!=auth()->user()->id){

    //         return $this->sendError("cant edit this");
    //     }

    //     $uss->enable=$input['enable'];
    //    $uss->save();

        return $this->Respone($uss->enable,'Success update');
        
    }

}
