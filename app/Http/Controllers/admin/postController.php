<?php

namespace App\Http\Controllers;

use App\Facades\Helpers;
use App\Http\Requests\CreatepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Repositories\postRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\User;

class postController extends AppBaseController
{
    /** @var  postRepository */
    private $postRepository;

    public function __construct(postRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the post.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postRepository->pushCriteria(new RequestCriteria($request));
        $posts = $this->postRepository->all();

        return view('admin.posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param CreatepostRequest $request
     *
     * @return Response
     */
    public function store(CreatepostRequest $request)
    {
        $input = $request->all();
        if ($request->has('image')){
            $imageName = Helpers::uploadImage($request->file('image'));
            $input['image'] = $imageName;
        }

        if ($request->has('ownerid')){
            $user = User::find($request->input('ownerid'));
            if (!empty($user)){
                if ($user->user_role == 0)
                    $input['ownertype'] = 'User';
                else
                    $input['ownertype'] = 'Admin';
            }else{
                Flash::success('User Not Found.');
                return redirect(route('posts.index'));
            }
        }

        if ($this->postRepository->create($input))
            Flash::success('Post saved successfully.');
        else
            Flash::success('Error Saving Post.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('admin.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('admin.posts.edit')->with('post', $post);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  int              $id
     * @param UpdatepostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepostRequest $request)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $inputs = $request->all();
        if ($request->has('image')){
            $imageName = Helpers::uploadImage($request->file('image'));
            $inputs['image'] = $imageName;
        }


        $post = $this->postRepository->update($inputs, $id);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findWithoutFail($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}
