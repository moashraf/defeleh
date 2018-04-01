<?php
namespace App\Http\Controllers\api;

use App\Models\userFollow;
use App\Models\CompanyFollow;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facades\Helpers;
use App\Http\Requests\UpdatecompanyRequest;
use App\Repositories\companyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class followController extends AppBaseController
{
    
  
      public function user_follow(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'followed_user_id' => 'required'
    
        ];

        $validation = Helpers::validate($request->all() , $rules);

        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);


        $inputs = $request->all();
     $userFollow = userFollow::where('followed_user_id', '=', $request->followed_user_id ) ->where('user_id', '=', $request->user_id ) ->first();
   if( !is_null($userFollow) ){  return Helpers::returnJsonResponse(false, '  follow  Already exists ..', null);  }
 else{
             if ($follow= userFollow::create($inputs))
            return Helpers::returnJsonResponse(true, 'follow created successfully ..', $follow);
         else
            return Helpers::returnJsonResponse(false, 'error follow ..', null);
     
     
 }

    }
 
 
 
   public function user_unfollow(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'followed_user_id' => 'required'
    
        ];

        $validation = Helpers::validate($request->all() , $rules);

        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);


        $inputs = $request->all();
     $userFollow = userFollow::where('followed_user_id', '=', $request->followed_user_id ) ->where('user_id', '=', $request->user_id ) ->first();
   if( !is_null($userFollow) )
   { 
       $userFollow->forceDelete();

       
       return Helpers::returnJsonResponse(true, '        user unfollow  ..', null);  }
        else{ 
            return Helpers::returnJsonResponse(false, 'error   ..', null);
           }

    }
    
    
    
 
  public function Company_unfollow(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'company_id' => 'required'
    
        ];

        $validation = Helpers::validate($request->all() , $rules);

        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);


        $inputs = $request->all();
     $CompanyFollow= CompanyFollow::where('company_id', '=', $request->company_id ) ->where('user_id', '=', $request->user_id ) ->first();
   if( !is_null($CompanyFollow) ){ 
       
        $CompanyFollow->forceDelete();
       return Helpers::returnJsonResponse(true, '   Company unfollow    ..', null);  }
 else{
             
            return Helpers::returnJsonResponse(false, 'error   ..', null);
      }

    }
 
 
 
 
 
  public function Company_Follow(Request $request)
    {
        $rules = [
            'user_id' => 'required',
            'company_id' => 'required'
    
        ];

        $validation = Helpers::validate($request->all() , $rules);

        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);


        $inputs = $request->all();
     $CompanyFollow= CompanyFollow::where('company_id', '=', $request->company_id ) ->where('user_id', '=', $request->user_id ) ->first();
   if( !is_null($CompanyFollow) ){  return Helpers::returnJsonResponse(false, '  follow  Already exists ..', null);  }
 else{
             if ($follow= CompanyFollow::create($inputs))
            return Helpers::returnJsonResponse(true, 'follow created successfully ..', $follow);
         else
            return Helpers::returnJsonResponse(false, 'error follow ..', null);
     
     
 }

    }
 
 
 
 
 
 
  
}

