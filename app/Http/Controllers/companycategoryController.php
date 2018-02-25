<?php

namespace App\Http\Controllers;
use App\Facades\Helpers;

use App\Models\companycategory;
use App\Http\Requests\CreatecompanycategoryRequest;
use App\Http\Requests\UpdatecompanycategoryRequest;
use App\Repositories\companycategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class companycategoryController extends AppBaseController
{
    /** @var  companycategoryRepository */
    private $companycategoryRepository;

    public function __construct(companycategoryRepository $companycategoryRepo)
    {
        $this->companycategoryRepository = $companycategoryRepo;
    }

    /**
     * Display a listing of the companycategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->companycategoryRepository->pushCriteria(new RequestCriteria($request));
        $companycategories = $this->companycategoryRepository->all();

        return view('companycategories.index')
            ->with('companycategories', $companycategories);
    }

    /**
     * Show the form for creating a new companycategory.
     *
     * @return Response
     */
    public function create()
    {

          $companies_cat = companycategory::all();
        return view('companycategories.create')->with('companies_cat', $companies_cat);

     }

    /**
     * Store a newly created companycategory in storage.
     *
     * @param CreatecompanycategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatecompanycategoryRequest $request)
    {

        $input = $request->all();

           $rules = [

        'name' => 'required',
        'image' => 'image|mimes:jpeg,bmp,png,jpg',
        // 'parentid' => 'required'
        ];

        $messages = [
        'name.required' => 'name required',
       // 'parentid.required' => 'required parent ',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all() , $rules, $messages);

        if ($validator->fails())
        {

            return redirect('companycategories/create')
                ->withErrors($validator)->withInput();
        }
        else
        {

 if (!empty($request->file('image'))){
            $imageName = Helpers::uploadImage($request->file('image'));
            $input['image'] = $imageName;
        }

            $companycategory = companycategory::create($input);

       //  $companycategory = $this->companycategoryRepository->create($input);

        Flash::success('Companycategory saved successfully.');

        return redirect(route('companycategories.index'));

        }
    }

    /**
     * Display the specified companycategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $companycategory = $this->companycategoryRepository->findWithoutFail($id);

        if (empty($companycategory)) {
            Flash::error('Companycategory not found');

            return redirect(route('companycategories.index'));
        }

        return view('companycategories.show')->with('companycategory', $companycategory);
    }

    /**
     * Show the form for editing the specified companycategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {


           $companies_cat = companycategory::all();
         $companycategory = $this->companycategoryRepository->findWithoutFail($id);

        if (empty($companycategory)) {
            Flash::error('Companycategory not found');

            return redirect(route('companycategories.index'));
        }

        return view('companycategories.edit')->with('companies_cat', $companies_cat)->with('companycategory', $companycategory);
    }

    /**
     * Update the specified companycategory in storage.
     *
     * @param  int              $id
     * @param UpdatecompanycategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecompanycategoryRequest $request)
    {
        $input = $request->all();

         $companycategory = $this->companycategoryRepository->findWithoutFail($id);


        if (empty($companycategory)) {
            Flash::error('Companycategory not found');

            return redirect(route('companycategories.index'));
        }

 if (!empty($request->file('image'))){
            $imageName = Helpers::uploadImage($request->file('image'));
            $input['image'] = $imageName;
        }

        
        $companycategory = $this->companycategoryRepository->update($input, $id);
         Flash::success('Companycategory updated successfully.');

        return redirect(route('companycategories.index'));
    }

    /**
     * Remove the specified companycategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $companycategory = $this->companycategoryRepository->findWithoutFail($id);

        if (empty($companycategory)) {
            Flash::error('Companycategory not found');

            return redirect(route('companycategories.index'));
        }

        $this->companycategoryRepository->delete($id);

        Flash::success('Companycategory deleted successfully.');

        return redirect(route('companycategories.index'));
    }
}
