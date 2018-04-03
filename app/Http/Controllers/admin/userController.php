<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{

    public function showSignup()
    {
        return view('admin.users.signup');
    }

    public function signup(Request $request){
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);


        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $inputs['user_role'] = 0;
        $inputs['api_token'] = str_random(25);

        if ($user = User::create($inputs)){
            Session::flash('success','User Created Successfully..');
            Auth::login($user);
            return redirect()->route('user-profile.index');
        } else{
            Session::flash('error','Error Creating User');
            return redirect()->back();
        }


    }

    public function showSignin(){
        return view('admin.users.signin');
    }

    public function signin(Request $request){
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('user-profile.index');
        }else{
            return redirect()->back();
        }
    }

}
