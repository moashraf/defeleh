<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
        $companycategories = companycategory::where('parentid', '=', 0) ->get();

        if (!$companycategories->isEmpty()) return Helpers::returnJsonResponse(true, 'categories listed successfully ..', $companycategories);

        else return Helpers::returnJsonResponse(false, 'categories not found ..', null);
    }

    public function get_children($cat_id)
    {

        $companycategory = companycategory::where('parentid', $cat_id)->orderBy('name', 'desc')
            ->get();

        if (!$companycategory->isEmpty()) return Helpers::returnJsonResponse(true, 'categories listed successfully ..', $companycategory);

        else return Helpers::returnJsonResponse(false, 'categories not found ..', null);
    }

}

