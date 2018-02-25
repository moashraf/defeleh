<?php

 
 namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\companycategory;
use App\Http\Requests\CreatecompanycategoryRequest;
use App\Http\Requests\UpdatecompanycategoryRequest;
use App\Repositories\companycategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class apicompanycategoryController extends AppBaseController
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

       

        if ( !$companycategories->isEmpty()){
            return response()->json([
                'status' => true,
               'message' => 'companycategory successfully',
                'data' => $companycategories
           ]  ,200,
           ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE
);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'error  not found  companycategory '
            ]);
      }





    }

   
 

  
    
 
}
