<?php

namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Repositories\postRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\post as Post;
use Illuminate\Support\Facades\Validator;

class apiPostController extends Controller
{
    private $postRepository;

    public function __construct(postRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $posts = $this->postRepository->all();

        if (count($posts) > 0)
            return Helpers::returnJsonResponse(true,'posts listed successfully', $this->postRepository->with('comments')->with('likes')->get());
        else
            return Helpers::returnJsonResponse(false,'no posts existed',null);
    }

    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|min:3',
            'content' => 'required|min:3',
           // 'image' => 'required'
        ];

        $validation = Helpers::validate($request->all() , $rules);

        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);

        $inputs = $request->all();
        if(!empty($request->input('image'))){

            $imageName = Helpers::uploadImage64($request->input('image'));
            $inputs['image'] = $imageName;
        }
        // if its owner (user) post, get it's type
        if ($request->has('ownerid')){
            $user = User::find($request->input('ownerid'));
            if (!empty($user)){
                if ($user->user_role == 0)
                    $inputs['ownertype'] = 'User';
                else
                    $inputs['ownertype'] = 'Admin';
            }else{
                return Helpers::returnJsonResponse(false,'user not found',null);
            }
        }

        if ($post = $this->postRepository->create($inputs)){
            return Helpers::returnJsonResponse(true,'post created successfully',$post);
        }else{
            return Helpers::returnJsonResponse(false,'error creating post',null);
        }

    }

    public function show(Request $request){

    $validator = Validator::make($request->all(), [
            'post_id' => 'required'
        ]);
         if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs    ...', null );
       $post = Post::where('id', '=', $request->input('post_id'))->with('comments')->with('likes')->first();

        if (empty($post))
            return Helpers::returnJsonResponse(false, 'post not found', null);
        else
            return Helpers::returnJsonResponse(true, 'post found successfully', $post);

    }

    public function update(Request $request, $id){
        $post = $this->postRepository->findWithoutFail($id);
        $inputs = $request->all();
        if (!empty($post)){
            if (!empty($request->input('image'))){
                $imageName = Helpers::uploadImage64($request->input('image'));
                $inputs['image'] = $imageName;
            } // end if image sent

            if ($post = $this->postRepository->update($inputs, $id))
                return Helpers::returnJsonResponse(true,'post updated', $post);
            else
                return Helpers::returnJsonResponse(false,'error updating post',null);

        }
        else{
            return Helpers::returnJsonResponse(false,'post not existed',null);
        }

    }

    public function delete($id){
        $post = $this->postRepository->findWithoutFail($id);

        if (!empty($post)){

            $post->likes()->delete();
            $post->comments()->delete();
            if ($post = $this->postRepository->delete($id))
                return Helpers::returnJsonResponse(true,'post deleted', $post);
            else
                return Helpers::returnJsonResponse(false,'error deleting post',null);

        }
        else{
            return Helpers::returnJsonResponse(false,'post not existed',null);
        }

    }

    public function getPosts(Request $request)
    {

        if ($request->has('companyid')){
            $posts = Post::where('companyid', '=', $request->input('companyid'))->with('comments')->with('likes')->get();
            if (count($posts) > 0)
                return Helpers::returnJsonResponse(true,'posts found successfully',$posts);
            else
                return Helpers::returnJsonResponse(false,'posts not found',null);
        } // if need company posts
        else if ($request->has('ownerid')){
            $posts = Post::where('ownerid', '=', $request->input('ownerid'))->with('comments')->with('likes')->get();
                
                
                for($i = 0 ; $i<count($posts);$i++){
                    $likes = $posts[$i]->likes ;
                  //  dd( $likes);
                    $isLiked = searchInLikes($request->input('ownerid'),$likes);
                    $posts[$i]->isLiked = $isLiked;
                }
                 
            if (count($posts) > 0)
                return Helpers::returnJsonResponse(true,'posts found successfully',$posts);
            else
                return Helpers::returnJsonResponse(false,'posts not found',null);
        }
    }
}

     function searchInLikes($current_id,$likes){
                   // dd($likes);

           foreach($likes as $like ){
               $id = $like->userid ;
               if($id == $current_id){
                   return true ;
               }
               
           }
           
           return false ;
    }
    
