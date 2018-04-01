<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class Helpers
{

    public function uploadImage($image){
        $imageName = time().'-'.$image->getClientOriginalName();
        $image->move('images',$imageName);
        return $imageName;
    }

    public  function uploadImage64($imgss){
        
   define('UPLOAD_DIR', 'images/');
	$img =$imgss ;
	$img = str_replace('data:image/jpeg;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.jpg';
 	$success = file_put_contents($file, $data);
$img_name= (explode("/",$file));
        return $img_name[1];
    }

    public function uploadImages(array $images){
        $imageArray = "";
        foreach ($images as $image){
            $imageName = $this->uploadImage($image);
            $imageArray .= $imageName.',';
        }
        return rtrim($imageArray, ',');
    }

    public  function uploadImages64($imgs)
    {

        $imageArray = "";
        $images = explode('0000000000',$imgs);

        foreach ($images as $image){
            $data = explode(',', $image)[1];
            $imageName = str_random(6).time().'.jpg';
            $fileStream = fopen(public_path() . '/images/' . $imageName , "wb");
            fwrite($fileStream, base64_decode($data));
            fclose($fileStream);
            $imageArray .= $imageName.',';
        }

        return rtrim($imageArray, ',');
    }

    public function returnJsonResponse($status, $message, $data){
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

    public function validate($request, $rules){
        $validator = Validator::make($request, $rules);

        if ($validator->fails()){
            $messages = $validator->errors()->all();
            $errorString = "Errors : ";
            foreach ($messages as $message) {
                $errorString .= $message . ' ';
            }
            return $errorString;
        } // end if fails
        else{
            return false;
        }
    }

}