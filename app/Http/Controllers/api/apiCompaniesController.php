<?php
namespace App\Http\Controllers\api;

use App\Models\company;
use App\Models\CompanyFollow;
use App\Models\companycategory;
use App\Models\userFollow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facades\Helpers;
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

    public static function company_search(Request $request )
    {

        $validator = Validator::make($request->all(), [
            'keyword' => 'required'
        ]);
         if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs    ...', null );

        $companies = company::where('name', 'LIKE', "%$request->keyword%")
        ->Orwhere('description', 'LIKE', "%$request->keyword%")
        ->get();
        if (  !$companies->isEmpty() ){ return Helpers::returnJsonResponse(true, 'companies listed successfully ..', $companies);}
        else { return Helpers::returnJsonResponse(false, 'no companies existed ..', null);}
      
    }


 public static function fileToUpload($image)
    {

        $nameDataSheet = "picture" . rand();
        $imageNameDataSheet = $nameDataSheet . '.' . $image->getClientOriginalExtension();
        $image->move(base_path() . '/public/upload/', $imageNameDataSheet);
        return $imageNameDataSheet;
    }
    
    
    
    public function cat(Request $request)
    {

$validator = Validator::make($request->all(), [
            'cat_id' => 'required'
        ]);
         if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs    ...', null );


        $companies = company::where('categoryid', '=', $request->cat_id )->get();

        if (!$companies->isEmpty()) return Helpers::returnJsonResponse(true, 'companies listed successfully ..', $companies);
        else return Helpers::returnJsonResponse(false, 'companies not existed ..', null);

    }

    public function cat_and_company()
    { 


        $cat_and_company = companycategory::with('get_company')->get();

        if (!$cat_and_company->isEmpty()) return Helpers::returnJsonResponse(true, 'cat and company listed successfully ..', $cat_and_company);
        else return Helpers::returnJsonResponse(false, 'cat and company  not existed ..', null);

    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required', 
            'categoryid' => 'required', 
            'ownerid' => 'required', 
            'image' => 'required',
            'address' => 'required', 
             'phones' => 'required', 
             'description' => 'required',
             'area' => 'required',
             'city' => 'required',
             'website_company' => 'required|url', 
            'facebook_page' => 'url'

        ];

        $validation = Helpers::validate($request->all() , $rules);

        if ($validation != false) return Helpers::returnJsonResponse(false, $validation, null);

        $inputs = $request->all();
         $inputs['company_code']= (rand(1000,3000));
        
         if(!empty($request->input('image'))){

            $imageName = Helpers::uploadImage64($request->input('image'));
            $inputs['image'] = $imageName;
        }

        if ($company = company::create($inputs)) return Helpers::returnJsonResponse(true, 'company created successfully ..', $company);
        else return Helpers::returnJsonResponse(false, 'error creating company ..', null);

    }

    /**
     * Display the specified company.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Request $request)
    {
             $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
         if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs    ...', null );

        $companies = company::where('id', '=', $request->id)
            ->with('get_company_cat')
            ->with('get_company_products')
            ->with('get_company_post')
            ->with('get_company_user') 
            ->with('get_followers')
            ->with('get_company_jobs')
            ->first();

        if (!is_null($companies)) return Helpers::returnJsonResponse(true, 'companies listed successfully ..', $companies);
        else return Helpers::returnJsonResponse(false, 'no companies existed ..', null);

    }

    public function company_like(Request $request)
    {
        
        $userFollow=userFollow::where('user_id', $request->user_id )->pluck('followed_user_id');
 // $company = DB::table('company') ->whereIn('ownerid', $userFollow)->get();
               if (!is_null($companies)) 
                return Helpers::returnJsonResponse(true, 'companies listed successfully ..', $userFollow);
        else return Helpers::returnJsonResponse(false, 'no companies existed ..', null);

    }




    public function get_popular()
    {

        $companies = company::where('popular', '=', 1)->get();

        if (!is_null($companies)) return Helpers::returnJsonResponse(true, 'companies listed successfully ..', $companies);
        else return Helpers::returnJsonResponse(false, 'no companies existed ..', null);

    }
    
    
    
    
    public function my_followed_company(Request $request)
    {

  $validator = Validator::make($request->all(), [
            'user_id' => 'required',
         ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs  user id ...',null);
            
            
        $CompanyFollow=CompanyFollow::where('user_id', $request->user_id )->pluck('company_id');
        $company =  company::whereIn ('id', $CompanyFollow)->get();
        if (!is_null($company)) return Helpers::returnJsonResponse(true, 'companies listed successfully ..', $company);
        else return Helpers::returnJsonResponse(false, 'no companies existed ..', null);

    }
    
    
   public function my_company(Request $request)
    {
  $validator = Validator::make($request->all(), [
            'user_id' => 'required',
         ]);
        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs  user id ...',null);
         $my_company=company::where('ownerid',$request->user_id )->get();
        if (!is_null($my_company)) return Helpers::returnJsonResponse(true, 'my company listed successfully ..', $my_company);
        else return Helpers::returnJsonResponse(false, 'no companies existed ..', null);



    }


}

