<?php

namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class apiProfileController extends Controller
{
    public function apiCreateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'fullname' => 'required:min:3',
            'cellphone' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()){
            return Helpers::returnJsonResponse(false,'Error , Missing inputs',null);

        }

        // check if this user already have profile
        if ($user = User::find($request->userid)){
            if (empty($user->profile)){
                $inputs = $request->all();
                if (!empty($request->file('profileimage'))){
                    $imageName = Helpers::uploadImage($request->file('profileimage'));
                    $inputs['profileimage'] = $imageName;
                }


                if ($profile = $user->profile()->create($inputs))
                    return Helpers::returnJsonResponse(true,'profile created successfully',$profile);
                else
                    return Helpers::returnJsonResponse(false,'error creating profile',null);


            } // end if user dont have profile
            else{
                return Helpers::returnJsonResponse(false,'user already have profile',null);
            }
        }
        //else if user existed
        else{
            return Helpers::returnJsonResponse(false,'user not existed',null);
        }





    }

    public function apiUpdateProfile(Request $request){


        $user = User::find($request->userid);
        if (empty($user->profile))
            return Helpers::returnJsonResponse(false,'user dont have profile',null);


        $inputs = $request->all();
        if (!empty($request->file('profileimage'))){
            $imageName = Helpers::uploadImage($request->file('profileimage'));
            $inputs['profileimage'] = $imageName;
        }

        if ($user->profile()->update($inputs))
            return Helpers::returnJsonResponse(true,'profile updated successfully',User::find($request->userid)->profile);
        else
            return Helpers::returnJsonResponse(false,'user dont have profile',null);


    }

    public function apiGetProfile($id){
        $user = User::find($id);

        if (empty($user->profile))
            return Helpers::returnJsonResponse(false,'user dont have profile',null);
        else
            return Helpers::returnJsonResponse(true,'Profile Listed Successfully',$user->profile);

    }

}
