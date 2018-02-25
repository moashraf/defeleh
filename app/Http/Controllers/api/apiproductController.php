<?php

namespace App\Http\Controllers\api;

use App\Models\product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatejobRequest;
use App\Http\Requests\UpdatejobRequest;
use App\Repositories\jobRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class apiproductController extends AppBaseController
{
    /** @var  jobRepository */
    private $jobRepository;

    public function __construct(jobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }
    /**
     * Display a listing of the product.
     *
     * @param Request $request
     * @return Response
     */
    public function index($companyid)
    {
         $product = product::where('companyid', '=', $companyid )->get();
                   if (!$product->isEmpty() ){
            return response()->json([
                'status' => true,
               'message' => 'product  successfully',
                'data' => $product
           ]  ,200,
           ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE
);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'error not    product found '
            ]);
      }
    }

 
  public function show($id)
    {
         $product = product::find($id);

         if (!is_null($product) ){
            return response()->json([
                'status' => true,
               'message' => 'product  successfully',
                'data' => $product
           ]  ,200,
           ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE
);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => 'error not    product found '
            ]);
      }

    }




}
