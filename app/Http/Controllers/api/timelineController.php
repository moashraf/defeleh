<?php
namespace App\Http\Controllers\api;
 use App\Facades\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\userFollow;
use App\Models\CompanyFollow;
use App\Models\post;
class timelineController extends Controller
{
  
    

    public function timeline (Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
           // 'company_id' => 'required'
         ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs  user id ...',null);
  
  $userFollow=userFollow::where('user_id', $request->user_id )->pluck('followed_user_id');
  $post =post::whereIn('ownerid', $userFollow)->with('comments')->with('likes')->get();
            
            
          //  $CompanyFollow=CompanyFollow::where('company_id', $request->company_id )->pluck('company_id');
  //$post.=post::whereIn('companyid', $CompanyFollow)->with('comments')->with('likes')->get();
  
  
  
         if( !$post->isEmpty()){      
     return Helpers::returnJsonResponse(true,'  post  successfully...', $post);
         } else{
            return Helpers::returnJsonResponse(false,'error   ...',null);}
  
                    
  
 

    } 



}
