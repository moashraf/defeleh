<?php
namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class apiSigninController extends Controller
{

    public function forget_password_step1(Request $request)
    {

        $validator = Validator::make($request->all() , ['email' => 'required|email']);

        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs  ...', null);

        $user = user::where('email', $request->input('email'))
            ->first();

        if (!is_null($user))
        {
            $activate = (rand(1000, 3000));
            $to = "$user->email";
            $subject = "Dfileh email";
            $message = Helpers::mail_code($activate, $user->email);
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <info@defileh.com>' . "\r\n";
           // mail($to, $subject, $message, $headers);
            $user->activate = $activate;
            $user->save();

            return Helpers::returnJsonResponse(true, '     successfully  send ...', $user);
        }
        else
        {
            return Helpers::returnJsonResponse(false, ' code  not send ...', null);
        }

    }

    public function forget_password_step2(Request $request)
    {

        $validator = Validator::make($request->all() , ['new_pass' => 'required', 'email' => 'required', 'code' => 'required']);
        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs     ...', null);
        $user = user::where('email', $request->input('email'))
            ->first();
        if (!is_null($user))
        {

            if ($user->activate == $request->code)
            {
                $user->activate = "1";
                $user->password = bcrypt($request->input('new_pass'));
                $user->save();

                return Helpers::returnJsonResponse(true, '     successfully  Send  ...', $user);
            }
            else
            {
                return Helpers::returnJsonResponse(false, ' activate code  not found ...', null);
            }

        }
        else
        {
            return Helpers::returnJsonResponse(false, ' activate code  not found ...', null);
        }

    }

    public function active_my_account(Request $request)
    {

        $validator = Validator::make($request->all() , [

        'user_id' => 'required', 'code' => 'required'

        ]);
        $errors = $validator->errors();
        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs  ...', null);

        $user = user::find($request->user_id);
        if ($user->activate == $request->code)
        {
            $user->activate = "1";
            $user->save();

            return Helpers::returnJsonResponse(true, ' successfully  activated ...', $user);
        }
        else
        {
            return Helpers::returnJsonResponse(false, ' code  not activated ...', null);
        }

    }

    public function social_login(Request $request)
    {

        $validator = Validator::make($request->all() , ['name' => 'required|min:3', 'social_id' => 'required|min:3', 'email' => 'required|email',
        // 'password' => 'required'
        ]);

        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs or email already existes  ...', null);
        $user = user::where('social_id', $request->input('social_id'))
            ->first();
        if (is_null($user))
        {

            $user_email = user::where('email', $request->input('email'))
                ->first();
            if (is_null($user_email))
            {
                $inputs = $request->all();
                $inputs['password'] = bcrypt($request->password);
                $inputs['user_role'] = 0;
                $inputs['social_id'] = $request->input('social_id');
                $inputs['api_token'] = str_random(25);
                $inputs['activate'] = 1;

                if ($user = User::create($inputs))
                {

                    $profileInputs = [];
                    if ($request->input('fullname'))
                    {
                        $profileInputs['fullname'] = $request->input('fullname');
                    }
                    else
                    {
                        $profileInputs['fullname'] = ('Your name');
                    }

                    if ($request->input('cellphone'))
                    {
                        $profileInputs['cellphone'] = $request->input('cellphone');
                    }
                    else
                    {
                        $profileInputs['cellphone'] = ('0000');
                    }

                    if ($request->input('address'))
                    {
                        $profileInputs['address'] = $request->input('address');
                    }
                    else
                    {
                        $profileInputs['address'] = ('address');
                    }
                    $inputs = $request->all();
                    //  dd($request->profileimage);
                    if (!empty($request->profileimage))
                    {

                        $imageName = Helpers::uploadImage64($request->profileimage);
                        $profileInputs['profileimage'] = $imageName;

                    }

                    if (!$user->profile()
                        ->create($profileInputs)) return Helpers::returnJsonResponse(false, 'error creating social  Profile...', null);

                    return Helpers::returnJsonResponse(true, 'user created social   successfully...', $user);
                    // add profile
                    
                }
                else
                {
                    return Helpers::returnJsonResponse(false, 'error creating  social  user...', null);
                } // end else
                

                
            }
            else
            {
                return Helpers::returnJsonResponse(false, 'Error ,   email already existes  ...', $user);
            }

        }
        else
        {

            //  dd( "ddd".Auth::user());
            return Helpers::returnJsonResponse(true, 'user logged in social successfully...', $user);
        }

    }

    public function resending_email(Request $request)
    {

        $validator = Validator::make($request->all() , ['user_id' => 'required|min:3']);

        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs or email already existes  ...', null);

        $user = user::find($request->user_id);

        if ($user)
        {
            $activate = (rand(1000, 3000));
            $to = "$user->email";
            $subject = "defileh email";
            $message = Helpers::mail_code($activate, $user->email);;
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <info@defileh.com>' . "\r\n";
            mail($to, $subject, $message, $headers);
            $user->activate = $activate;
            $user->save();

            return Helpers::returnJsonResponse(true, '     successfully  send ...', null);
        }
        else
        {
            return Helpers::returnJsonResponse(false, ' code  not send ...', null);
        }

    }

    public function apiSignin(Request $request)
    {

        $validator = Validator::make($request->all() , ['email' => 'required',

        'password' => 'required']);

        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs or email already existes...', null);

        if (Auth::attempt(['email' => $request->input('email') , 'password' => $request->input('password') ]))
        {

            $get_user_id = user::where('email', $request->input('email'))
                ->first();

            if (!is_null($get_user_id))
            {

                if ($get_user_id->activate == 0)
                {
                    return Helpers::returnJsonResponse(true, 'user logged in successfully...', Auth::user());
                }

                else
                {
                    return Helpers::returnJsonResponse(false, 'user  not activated  activate==0  ...', $get_user_id);
                }

            }
        }

        else
        {
            if (Auth::attempt(['user_name' => $request->input('email') , 'password' => $request->input('password') ]))
            {

                $get_user_id = user::where('user_name', $request->input('email'))
                    ->first();

                if ($get_user_id->activate == 0)
                {
                    return Helpers::returnJsonResponse(true, 'user logged in successfully...', Auth::user());
                }

                else
                {
                    return Helpers::returnJsonResponse(false, 'user  not activated  activate==0  ...', $get_user_id);
                }
            }

            else
            {
                return Helpers::returnJsonResponse(false, 'error signing in...', null);
            }

        }
        // end else
        

        
    } // end apiSignup function
    public function apiSignup(Request $request)
    {

        $validator = Validator::make($request->all() , [

        'user_name' => 'required|min:5|unique:users', 'name' => 'required|min:3', 'email' => 'required|email|unique:users', 'password' => 'required']);

        if ($validator->fails()) return Helpers::returnJsonResponse(false, 'Error , Missing inputs or email already exists...', null);

        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $inputs['user_role'] = 0;
        $inputs['api_token'] = str_random(25);
        $activate = (rand(1000, 3000));
        $inputs['activate'] = $activate;

        if ($user = User::create($inputs))
        {

            $to = "$request->email";
            $subject = "defileh email";

            $message = Helpers::mail_code($activate, $request->email);;

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <info@defileh.com>' . "\r\n";

            mail($to, $subject, $message, $headers);

            $profileInputs = [];

            $profileInputs['fullname'] = $request->input('fullname');
            $profileInputs['cellphone'] = $request->input('cellphone');

            $inputs = $request->all();
            if (!empty($request->input('profileimage')))
            {

                $imageName = Helpers::uploadImage64($request->input('profileimage'));
                $profileInputs['profileimage'] = $imageName;
            }

            $profileInputs['address'] = $request->input('address');

            if (!$user->profile()
                ->create($profileInputs)) return Helpers::returnJsonResponse(false, 'error creating Profile...', null);

            return Helpers::returnJsonResponse(true, 'user created successfully...', $user);
            // add profile
            
        }
        else
        {
            return Helpers::returnJsonResponse(false, 'error creating user...', null);
        } // end else
        
    } // end apiSignup function
    
}

