<?php

namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Repositories\postRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Prettus\Repository\Criteria\RequestCriteria;

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
            return Helpers::returnJsonResponse(true,'posts listed successfully',$posts);
        else
            return Helpers::returnJsonResponse(false,'no posts existed',null);
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        if(!empty($request->file('image'))){
          $imageName = Helpers::uploadImage($request->file('image'));
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

    public function show($id){
        $post = $this->postRepository->findWithoutFail($id);
        if (empty($post))
            return Helpers::returnJsonResponse(false,'post not found',null);
        else
            return Helpers::returnJsonResponse(true,'post found successfully',$post);
    }

    public function update(Request $request, $id){
        $post = $this->postRepository->findWithoutFail($id);
        $inputs = $request->all();
        if (!empty($post)){
            if (!empty($request->file('image'))){
                $imageName = Helpers::uploadImage($request->file(image));
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
            $posts = $this->postRepository->findByField('companyid',$request->has('companyid'));
            if (count($posts) > 0)
                return Helpers::returnJsonResponse(true,'posts found successfully',$posts);
            else
                return Helpers::returnJsonResponse(false,'posts not found',null);
        } // if need company posts
        else if ($request->has('ownerid')){
            $posts = $this->postRepository->findByField('ownerid',$request->input('ownerid'));
            if (count($posts) > 0)
                return Helpers::returnJsonResponse(true,'posts found successfully',$posts);
            else
                return Helpers::returnJsonResponse(false,'posts not found',null);
        }
    }
}
