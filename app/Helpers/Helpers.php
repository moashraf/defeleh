<?php

namespace App\Helpers;

class Helpers
{

    public function uploadImage($image){
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move('images',$imageName);
        return $imageName;
    }

    public function  returnJsonResponse($status, $message, $data){
        if ($status == false){
            return response()->json([
                'status' => $status,
                'message' => $message
            ],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }else if ($status == true){
            return response()->json([
                'status' => $status,
                'messages' => $message,
                'data' => $data
            ],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'error existed'
            ],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

}