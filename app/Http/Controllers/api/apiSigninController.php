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


       public static  function mail_code($code,$mail){

      $body= "
<!doctype html>
<html>
  <head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Simple Transactional Email</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }
      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }
      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */
      .body {
        background-color: #f6f6f6;
        width: 100%; }
      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }
      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }
      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }
      .wrapper {
        box-sizing: border-box;
        padding: 20px; }
      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }
      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }
      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }
      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }
      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }
      a {
        color: #3498db;
        text-decoration: underline; }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }
      .btn-primary table td {
        background-color: #3498db; }
      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }
      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }
      .first {
        margin-top: 0; }
      .align-center {
        text-align: center; }
      .align-right {
        text-align: right; }
      .align-left {
        text-align: left; }
      .clear {
        clear: both; }
      .mt0 {
        margin-top: 0; }
      .mb0 {
        margin-bottom: 0; }
      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }
      .powered-by a {
        text-decoration: none; }
      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }
      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}
      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }
    </style>
  </head>
  <body class=''>
    <table border='0' cellpadding='0' cellspacing='0' class='body'>
      <tr>
        <td>&nbsp;</td>
        <td class='container'>
          <div class='content'>

            <!-- START CENTERED WHITE CONTAINER -->
            <span class='preheader'>This is preheader text. Some clients will show this text as a preview.</span>
            <table class='main'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper'>
                  <table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td>
                        <p>Hi there,</p>
                        <p> Welcome   $mail 

You can confirm your account through the code below:  </p>
                        <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary'>
                          <tbody>
                            <tr>
                              <td align='left'>
                                <table border='0' cellpadding='0' cellspacing='0'>
                                  <tbody>
                                    <tr>
                                      <td> <a href=' ' target='_blank'>  $code   </a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                         <p>Good luck! Hope it works.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class='footer'>
              <table border='0' cellpadding='0' cellspacing='0'>
                
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";
return  $body ;

    } 


    public function active_my_account( $user_id ,$code ){
        $user = user::find( $user_id );
         if( $user->activate== $code ){
        $user->activate="1";
        $user->save();
        
         return Helpers::returnJsonResponse(true,'     successfully  activated ...' ,true );
                }else{
                    return Helpers::returnJsonResponse(true,' code  not activated ...' ,null );
                }

        
        
        
    }

 public function social_login(Request $request){
        
        
             $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'social_id' => 'required|min:3',
            'email' => 'required|email',
           // 'password' => 'required'
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs or email already existes  ...',null);
    $user= user::where('social_id',  $request->input('social_id'))->first();
  if ( is_null($user)){
      
       $user_email= user::where('email',  $request->input('email'))->first();
         if(  is_null($user_email)  ){ 
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $inputs['user_role'] = 0;
        $inputs['social_id'] = $request->input('social_id');
        $inputs['api_token'] = str_random(25);
        $inputs['activate'] =  1;

        if ($user = User::create($inputs)){
            
             $profileInputs = [];
              if ($request->input('fullname')){ $profileInputs['fullname'] = $request->input('fullname');}
              else{$profileInputs['fullname'] =('Your name'); }
              
                    if ($request->input('cellphone')){ $profileInputs['cellphone'] = $request->input('cellphone');}
              else{$profileInputs['cellphone'] =('0000'); }
              
                    if ($request->input('address')){ $profileInputs['address'] = $request->input('address');}
              else{$profileInputs['address'] =('address'); }
              $inputs = $request->all();
              //  dd($request->profileimage);
        if(!empty($request->profileimage)){

           $imageName = Helpers::uploadImage64( $request->profileimage );
            $profileInputs['profileimage'] =   $imageName;
                    
         }
       
          

            if (! $user->profile()->create($profileInputs))
                return Helpers::returnJsonResponse(false,'error creating social  Profile...',null);

            return Helpers::returnJsonResponse(true,'user created social   successfully...', $user);
            // add profile
        } else{
            return Helpers::returnJsonResponse(false,'error creating  social  user...',null);
        }// end else
 
      
         }else{
            return Helpers::returnJsonResponse(false,'Error ,   email already existes  ...', $user);
        }
      
      
  }else{
      
      //  dd( "ddd".Auth::user());
            return Helpers::returnJsonResponse(true,'user logged in social successfully...', $user );
        }
        
        
        
        
    }
 
      public function resending_email( $user_id  ){
        $user = user::find( $user_id );
        
         if( $user){
            $activate=   (rand(1000,3000));
            $to = "$user->email";
            $subject = "defileh email";

            $message =   apiSigninController::mail_code($activate,$user->email);;

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <info@defileh.com>' . "\r\n";

            mail($to, $subject, $message, $headers);
            
            
            
            
        $user->activate=$activate;
        $user->save();
        
         return Helpers::returnJsonResponse(true,'     successfully  send ...' ,null );
                }else{
                    return Helpers::returnJsonResponse(true,' code  not send ...' ,null );
                }

        
        
        
    }
    
    
    
    

    public function apiSignin(Request $request){

        $validator = Validator::make($request->all(), [
                     'email' => 'required',

            'password' => 'required'
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs or email already existes...',null);



        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
       
        $get_user_id= user::where('email',  $request->input('email'))->first();
      
       if( !is_null($get_user_id)){
        
         if($get_user_id->activate==1){      return Helpers::returnJsonResponse(true,'user logged in successfully...', Auth::user());}
         
         else{  return Helpers::returnJsonResponse(false,'user  not activated  activate==0  ...' ,  $get_user_id );}
         
         }  
        } 
            
             
          else  {
               if (Auth::attempt(['user_name' => $request->input('email'), 'password' => $request->input('password')])){
         
        $get_user_id= user::where('user_name',  $request->input('email'))->first();
        
        
        
         if($get_user_id->activate==1){      return Helpers::returnJsonResponse(true,'user logged in successfully...', Auth::user());}
         
         else{  return Helpers::returnJsonResponse(false,'user  not activated  activate==0  ...' ,  $get_user_id );}
            } 
            
           else  {  return Helpers::returnJsonResponse(false,'error signing in...',null);}  
            
          }
        // end else


    }// end apiSignup function

    public function apiSignup(Request $request){
 
          $validator = Validator::make($request->all(), [
              
            'user_name' => 'required|min:5|unique:users',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs or email already exists...',null);


        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $inputs['user_role'] = 0;
        $inputs['api_token'] = str_random(25);
        $activate=   (rand(1000,3000));
        $inputs['activate'] =   $activate;

        if ($user = User::create($inputs)){


            $to = "$request->email";
            $subject = "defileh email";

            $message =   apiSigninController::mail_code($activate,$request->email);;

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
        if(!empty($request->input('profileimage'))){

            $imageName = Helpers::uploadImage64($request->input('profileimage'));
                       $profileInputs['profileimage'] =   $imageName;
         }
       
            $profileInputs['address'] = $request->input('address');

            if (! $user->profile()->create($profileInputs))
                return Helpers::returnJsonResponse(false,'error creating Profile...',null);

            return Helpers::returnJsonResponse(true,'user created successfully...', $user);
            // add profile
        } else{
            return Helpers::returnJsonResponse(false,'error creating user...',null);
        }// end else

    } // end apiSignup function

}
