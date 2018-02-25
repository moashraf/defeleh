<?php

namespace App\Http\Controllers;

use App\Facades\Helpers;
use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\profile as Profile;

class mainProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('main.profile.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
       $inputs = $request->all();
       if (!empty($request->file('profileimage'))){
           $imageName = Helpers::uploadImage($request->file('profileimage'));
           $inputs['profileimage'] = $imageName;
       }

       $user = Auth::user();
       $user->profile()->create($inputs);
       return redirect()->route('user-profile.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        return view('main.profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('main.profile.update', compact(['profile','user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $inputs = $request->all();
        if (!empty($request->file('profileimage'))){
            $imageName = Helpers::uploadImage($request->file('profileimage'));
            $inputs['profileimage'] = $imageName;
        }
        $profile = Profile::find($id);
        $profile->update($inputs);
        return redirect()->route('user-profile.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
