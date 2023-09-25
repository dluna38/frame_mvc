<?php

namespace app\traits;

trait ApiResponse{

    public function sucessResponse($data=null, $code = 200, $msj="") { 
        return response()->json(array("data"=>$data,"code"=>$code,"msj"=>$msj),$code); 
    }
    public function errorResponse($data, $code = 500, $msj="") { 
        return response()->json(array("data"=>$data,"code"=>$code,"msj"=>$msj),$code); 
    }
}