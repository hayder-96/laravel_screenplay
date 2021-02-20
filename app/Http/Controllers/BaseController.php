<?php

namespace App\Http\Controllers;

use function PHPUnit\Framework\isEmpty;

class BaseController  extends Controller
{
   
    public function Respone($result,$message){


        $respone=[

            "success"=>true,
            "data"=>$result,
            "message"=>$message

        ];

        return  response()->json($respone,200);

    }

    public function sendError($error,$message=[]){

        $respone=[

            "success"=>false,
            "message"=>$error

        ];
        if(!isEmpty($message)){

           $respone['data']=$message;
        }

        return response()->json($respone,404);

    }




    public function Responeimage($message){


          $respone=[

           
            "message"=>$message

        ];
       

        return  response()->json($respone);

    }
}
