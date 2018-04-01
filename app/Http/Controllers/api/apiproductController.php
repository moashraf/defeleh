<?php

namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Models\product;
use App\Repositories\jobRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\productRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;


class apiproductController extends AppBaseController
{
    /** @var  jobRepository */
    private $productRepository;

    public function __construct(productRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }
    /**
     * Display a listing of the product.
     *
     * @param Request $request
     * @return Response
     */
    public function index($companyid)
    {
        $products = product::where('companyid', '=', $companyid )->get();
        if (!$products->isEmpty() )
            return Helpers::returnJsonResponse(true, 'products found successfully ..', $products);
        else
            return Helpers::returnJsonResponse(false, 'products not found ..', null);
      }

    public function show($id)
    {
        $product = product::find($id);

        if (!is_null($product) )
            return Helpers::returnJsonResponse(true, 'product found successfully ..', $product);
        else
            return Helpers::returnJsonResponse(false, 'product not found ..', null);

    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|min:3',
            'image' => 'required',
            'description' => 'required|min:3',
            'companyid' => 'required',
            'price' => 'required',
            'fabric' => 'required',
            'least' => 'required',
            'colors' => 'required',
          //  'images' => 'required'
        ];

        $validation = Helpers::validate($request->all() , $rules);
        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);

        $inputs = $request->all();

        if (!empty($request->input('image'))){
            $imageName = Helpers::uploadImage64($request->input('image'));
            $inputs['image'] = $imageName;
        }

     //   if (!empty($request->input('images'))){
            // function for array image 64
        //    $imageNames = Helpers::uploadImages64($request->input('images'));
        //    $inputs['images'] = $imageNames;
       // }

        if ($product = $this->productRepository->create($inputs))
            return Helpers::returnJsonResponse(true, 'Product Created Successfully ..', $product);
        else
            return Helpers::returnJsonResponse(false, 'Error Creating Product ..', null);


    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepository->findWithoutFail($id);
        $inputs = $request->all();
        if (!empty($product)){

            // if image sent upload it
            if (!empty($request->input('image'))){
                $imageName = Helpers::uploadImage64($request->input('image'));
                $inputs['image'] = $imageName;
            }

            // if images sent upload it
            if (!empty($request->input('images'))){
                // function for array image 64
                $imageNames = Helpers::uploadImages64($request->input('images'));
                $inputs['images'] = $imageNames;
            }

            if ($product = $this->productRepository->update($inputs, $id))
                return Helpers::returnJsonResponse(true,'product updated successfully ..', $product);
            else
                return Helpers::returnJsonResponse(false, 'error updating product ..', null);

        }
        else
            return Helpers::returnJsonResponse(false, 'product not existed .. ', null);

    }

    public function delete($id){
        $comment = $this->productRepository->findWithoutFail($id);


        if (!empty($comment)){

            if ($comment = $this->productRepository->delete($id))
                return Helpers::returnJsonResponse(true,'product deleted ..', null);
            else
                return Helpers::returnJsonResponse(false,'error deleting product ..',null);

        }
        else
            return Helpers::returnJsonResponse(false,'product not existed',null);
    }

}
