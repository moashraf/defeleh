<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatelikeRequest;
use App\Http\Requests\UpdatelikeRequest;
use App\Repositories\likeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class likeController extends AppBaseController
{
    /** @var  likeRepository */
    private $likeRepository;

    public function __construct(likeRepository $likeRepo)
    {
        $this->likeRepository = $likeRepo;
    }

    /**
     * Display a listing of the like.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->likeRepository->pushCriteria(new RequestCriteria($request));
        $likes = $this->likeRepository->all();

        return view('likes.index')
            ->with('likes', $likes);
    }

    /**
     * Show the form for creating a new like.
     *
     * @return Response
     */
    public function create()
    {
        return view('likes.create');
    }

    /**
     * Store a newly created like in storage.
     *
     * @param CreatelikeRequest $request
     *
     * @return Response
     */
    public function store(CreatelikeRequest $request)
    {
        $input = $request->all();

        $like = $this->likeRepository->create($input);

        Flash::success('Like saved successfully.');

        return redirect(route('likes.index'));
    }

    /**
     * Display the specified like.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        return view('likes.show')->with('like', $like);
    }

    /**
     * Show the form for editing the specified like.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        return view('likes.edit')->with('like', $like);
    }

    /**
     * Update the specified like in storage.
     *
     * @param  int              $id
     * @param UpdatelikeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelikeRequest $request)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        $like = $this->likeRepository->update($request->all(), $id);

        Flash::success('Like updated successfully.');

        return redirect(route('likes.index'));
    }

    /**
     * Remove the specified like from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $like = $this->likeRepository->findWithoutFail($id);

        if (empty($like)) {
            Flash::error('Like not found');

            return redirect(route('likes.index'));
        }

        $this->likeRepository->delete($id);

        Flash::success('Like deleted successfully.');

        return redirect(route('likes.index'));
    }
}
