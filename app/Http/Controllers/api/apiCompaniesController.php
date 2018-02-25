<?php
 namespace App\Http\Controllers\api;
 use App\Models\company;
use App\Models\companycategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\CreatecompanyRequest;
use App\Http\Requests\UpdatecompanyRequest;
use App\Repositories\companyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class apiCompaniesController extends AppBaseController
{
    /** @var  companyRepository */
    private $companyRepository;

    public function __construct(companyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
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
 
       
    if ( !$companies->isEmpty() ){
            return response()->json([
                'status' => true,
               'message' => 'company  successfully',
                'data' => $companies
           ]  ,200,
           ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE
);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'error not  company found '
            ]);
      }

    }
 
    public function store(CreatecompanyRequest $request)
    {

      $validator = Validator::make($request->all(), [
         'name' => 'required', 
         'categoryid' => 'required',
         'ownerid' => 'required',

        'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
        'address' => 'required', 'phones' => 'required', 'description' => 'required'

        ]);

        if ($validator->fails()){
                $errors = $validator->errors();

            return response()->json([
                'status' => false,
                'message' => "$errors "
            ],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

       $inputs = $request->all();
               $img = $this::fileToUpload($request->image);
            $inputs['image'] = $img;

        if ($company = company::create($inputs)){
            return response()->json([
                'response' => true,
                'message' => 'company created successfully',
                'data' => $company
            ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else{
            return response()->json([
                'response' => false,
                'message' => 'error creating company',
            ], 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }// end else
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
   
    $companies = company::where('id', '=', $id)
     ->with('get_company_cat')
      ->with('get_company_products')
       ->with('get_company_post')
       ->with('get_company_user')
           ->with('get_company_jobs')->first();
      if ( !is_null($companies) ){
            return response()->json([
                'status' => true,
               'message' => 'company  successfully',
                'data' => $companies
           ]  ,200,
           ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE
);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'error not found   company '
            ]);
      }
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

