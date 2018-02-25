<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class apiSigninController extends Controller
{

    public function apiSignin(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Error , Missing inputs or email already existes...'
            ],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return response()->json([
                'response' => true,
                'message' => 'user logged in successfully',
                'data' => Auth::user()
            ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json([
                'response' => false,
                'message' => 'error signing in',
            ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }// end else


    }// end apiSignup function

    public function apiSignup(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Error , Missing inputs or email already existes...'
            ],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $inputs['user_role'] = 0;
        $inputs['api_token'] = str_random(25);


        if ($user = User::create($inputs)){
            return response()->json([
                'response' => true,
                'message' => 'user created successfully',
                'data' => $user
            ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json([
                'response' => false,
                'message' => 'error creating user',
            ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }// end else

    } // end apiSignup function

}
