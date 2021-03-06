<?php

namespace App\Http\Controllers;

use App\Facades\Helpers;
use App\Http\Requests\CreateprofileRequest;
use App\Http\Requests\UpdateprofileRequest;
use App\Repositories\profileRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class profileController extends AppBaseController
{
    /** @var  profileRepository */
    private $profileRepository;

    public function __construct(profileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
    }

    /**
     * Display a listing of the profile.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->profileRepository->pushCriteria(new RequestCriteria($request));
        $profiles = $this->profileRepository->all();

        return view('admin.profiles.index')
            ->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new profile.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.profiles.create');
    }

    /**
     * Store a newly created profile in storage.
     *
     * @param CreateprofileRequest $request
     *
     * @return Response
     */
    public function store(CreateprofileRequest $request)
    {

        $inputs = $request->all();
        if (!empty($request->file('profileimage'))){
            $imageName = Helpers::uploadImage($request->file('profileimage'));
            $inputs['profileimage'] = $imageName;
        }

        $profile = $this->profileRepository->create($inputs);

        Flash::success('admin.Profile saved successfully.');

        return redirect(route('profiles.index'));
    }

    /**
     * Display the specified profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('admin.profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified profile.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        return view('admin.profiles.edit')->with('profile', $profile);
    }

    /**
     * Update the specified profile in storage.
     *
     * @param  int              $id
     * @param UpdateprofileRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprofileRequest $request)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $inputs = $request->all();
        if (!empty($request->file('profileimage'))){
            $imageName = Helpers::uploadImage($request->file('profileimage'));
            $inputs['profileimage'] = $imageName;
        }
        $profile = $this->profileRepository->update($inputs, $id);

        Flash::success('Profile updated successfully.');

        return redirect(route('profiles.index'));
    }

    /**
     * Remove the specified profile from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $profile = $this->profileRepository->findWithoutFail($id);

        if (empty($profile)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.index'));
        }

        $this->profileRepository->delete($id);

        Flash::success('Profile deleted successfully.');

        return redirect(route('profiles.index'));
    }
}
