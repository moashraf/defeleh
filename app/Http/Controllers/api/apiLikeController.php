<?php

namespace App\Http\Controllers\API;

use App\Facades\Helpers;
use App\Repositories\likeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post as Post;
use App\Models\like as Like;
use App\Models\company as company;

class apiLikeController extends Controller
{

    private $likeRepository;

    public function __construct(likeRepository $likeRepo)
    {
        $this->likeRepository = $likeRepo;
    }

    public function store(Request $request)
    {


        $rules = [
            'userid' => 'required',
            'postid' => 'required'
        ];

        $validation = Helpers::validate($request->all() , $rules);
        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);

        $existedLikes = Like::where('userid', '=', $request->userid)->where('postid', '=', $request->postid)->get();
        if (count($existedLikes) > 0)
            return Helpers::returnJsonResponse(false, 'User already likes this post ..', null);

        // if user likes this post already
        else{
            $post = Post::find($request->input('postid'));

            if (empty($post))
                return Helpers::returnJsonResponse(false, 'Post not found ..', null);

            if ($comment = $post->likes()->create($request->all()))
                return Helpers::returnJsonResponse(true, 'Like Created Successfully ..', $comment);
            else
                return Helpers::returnJsonResponse(false, 'Error Creating Like ..', null);
        }

    }

    public function delete($id){

        $like = $this->likeRepository->findWithoutFail($id);

        if (!empty($like)){

            if ($like = $this->likeRepository->delete($id))
                return Helpers::returnJsonResponse(true,'Like deleted ..', null);
            else
                return Helpers::returnJsonResponse(false,'error deleting Like ..',null);

        }
        else{
            return Helpers::returnJsonResponse(false,'Like not existed',null);
        }
    }
    
    
    
    
       public function count_company_like($company_id){

 if (!empty($company_id)){
     
     
    //    $companies = company::where('id', '=', $company_id)
            //    ->with('get_like')->first();
               
               
               
//$like_count= like::where('company_id', $company_id )->get();



dd($companies);
}
        
    }
    
    
    
    
    
    
    
    

}
