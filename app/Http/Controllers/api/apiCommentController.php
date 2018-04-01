<?php

namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Http\Controllers\Controller;
use App\Repositories\commentRepository;
use Illuminate\Http\Request;
use App\Models\post as Post;
use App\Models\comment as Comment;
use Illuminate\Support\Facades\Validator;

class apiCommentController extends Controller
{

    private $commentRepository;

    public function __construct(commentRepository $commentRepo)
    {
        $this->commentRepository = $commentRepo;
    }

    public function store(Request $request)
    {

        $rules = [
            'content' => 'required|min:1',
            'ownerid' => 'required',
            'postid' => 'required'
        ];

        $validation = Helpers::validate($request->all() , $rules);
        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);

        $post = Post::find($request->input('postid'));
        if (empty($post))
            return Helpers::returnJsonResponse(false, 'Post not found ..', null);

        if ($comment = $post->comments()->create($request->all()))
            return Helpers::returnJsonResponse(true, 'Comment Created Successfully ..', $comment);
        else
            return Helpers::returnJsonResponse(false, 'Error Creating Comment ..', null);

    }

    public function update(Request $request, $id)
    {
        $comment = $this->commentRepository->findWithoutFail($id);
        $inputs = $request->all();
        if (!empty($comment)){

            if ($comment = $this->commentRepository->update($inputs, $id))
                return Helpers::returnJsonResponse(true,'comment updated successfully ..', $comment);
            else
                return Helpers::returnJsonResponse(false, 'error updating comment ..', null);

        }else{
            return Helpers::returnJsonResponse(false, 'comment not existed .. ', null);
        }
    }

    public function delete($id){
        $comment = $this->commentRepository->findWithoutFail($id);

        if (!empty($comment)){

            if ($comment = $this->commentRepository->delete($id))
                return Helpers::returnJsonResponse(true,'comment deleted ..', null);
            else
                return Helpers::returnJsonResponse(false,'error deleting comment ..',null);

        }
        else
            return Helpers::returnJsonResponse(false,'comment not existed',null);

    }



}
