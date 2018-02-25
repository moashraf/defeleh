<?php
namespace App\Http\Controllers;
use App\Models\company;
use App\Models\companycategory;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreatecompanyRequest;
use App\Http\Requests\UpdatecompanyRequest;
use App\Repositories\companyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class mainCompaniesController extends AppBaseController
{
    /** @var  companyRepository */
    private $companyRepository;

    public function __construct(companyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    /**
     * Display a listing of the company.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

          $companies = company::where('ownerid', '=', Auth::id() )->paginate(2);


        return view('main.companies.My_Companies')
            ->with('companies', $companies);
    }

    public static function fileToUpload($image)
    {

        $nameDataSheet = "picture" . rand();
        $imageNameDataSheet = $nameDataSheet . '.' . $image->getClientOriginalExtension();
        $image->move(base_path() . '/public/upload/', $imageNameDataSheet);
        return $imageNameDataSheet;
    }

    public function cat($cat)
    {

        $companies = company::where('categoryid', '=', $cat)->get();
        return view('main.companies.all_cat_companies')
            ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new company.
     *
     * @return Response
     */
    public function create()
    {
        $companies_cat = companycategory::all();
        return view('main.companies.add_companies')->with('companies_cat', $companies_cat);
    }

    /**
     * Store a newly created company in storage.
     *
     * @param CreatecompanyRequest $request
     *
     * @return Response
     */
    public function store(CreatecompanyRequest $request)
    {

        $rules = [

        'name' => 'required', 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
        'address' => 'required', 'phones' => 'required', 'description' => 'required'

        ];

        $messages = [

        'name.required' => 'name required', 'image.required' => 'required image ', 'address.required' => 'required', 'phones.required' => 'required', 'description.required' => 'required',

        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all() , $rules, $messages);

        if ($validator->fails())
        {

            return redirect('mainCompanies/create')
                ->withErrors($validator)->withInput();
        }
        else
        {

            $input = $request->all();
            $input['ownerid'] = Auth::id();
            $img = $this::fileToUpload($request->image);

            $input['image'] = $img;

            $company = $this
                ->companyRepository
                ->create($input);

            Flash::success('Company saved successfully.');

            return redirect(route('companies.index'));
        }
    }

    /**
     * Display the specified company.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
      
         $company = $this
            ->companyRepository
            ->findWithoutFail($id);

        if (empty($company))
        {
            Flash::error('Company not found');

            return redirect(route('mainCompanies.index'));
        }

        return view('main.companies.single_companies')->with('company', $company);
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

                $companies_cat = companycategory::all();


        $company = $this
            ->companyRepository
            ->findWithoutFail($id);

        if (empty($company))
        {
            Flash::error('Company not found');

            return redirect(route('mainCompanies.index'));
        }

        return view('main.companies.edit_companies' , 
            ['company' => $company, 'companies_cat' => $companies_cat ]) ;
    }

    /**
     * Update the specified company in storage.
     *
     * @param  int              $id
     * @param UpdatecompanyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecompanyRequest $request)
    {
  

        $company = $this ->companyRepository  ->findWithoutFail($id);

        if (empty($company))
        {

            Flash::error('Company not found');
            return redirect(route('mainCompanies.index'));
        }

        $company = $this ->companyRepository ->update($request->all() , $id);
        Flash::success('Company updated successfully.');

        return redirect(route('mainCompanies.index'));
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $company = $this
            ->companyRepository
            ->findWithoutFail($id);

        if (empty($company))
        {
            Flash::error('Company not found');

            return redirect(route('mainCompanies.index'));
        }

        $this
            ->companyRepository
            ->delete($id);

        Flash::success('Company deleted successfully.');

        return redirect(route('mainCompanies.index'));
    }
}

