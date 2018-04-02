<?php

namespace App\Http\Controllers\api;

use App\Facades\Helpers;
use App\Models\job;
use App\Models\company;
use App\Repositories\jobRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Validator;

class apijobsController extends AppBaseController
{
    /** @var  jobRepository */
    private $jobRepository;

    public function __construct(jobRepository $jobRepo)
    {
        $this->jobRepository = $jobRepo;
    }
    /**
     * Display a listing of the job.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

  $validator = Validator::make($request->all(), [
            'company_id' => 'required'
        ]);
         if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs     ...', null );

        
        $jobs = job::where('companyid', '=', $request->company_id )->get();
        if (!$jobs->isEmpty() )
            return Helpers::returnJsonResponse(true, 'jobs Created Successfully ..', $jobs);
        else
            return Helpers::returnJsonResponse(false, 'jobs not found ..', null);

    }

     
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'contact' => 'required',
            'companyid' => 'required'
        ];

        $validation = Helpers::validate($request->all() , $rules);
        if ($validation != false)
            return Helpers::returnJsonResponse(false, $validation ,null);

        $inputs = $request->all();

        if (!empty(company::find($request->input('companyid')))){
            if ($job = $this->jobRepository->create($inputs))
                return Helpers::returnJsonResponse(true, 'Job Created Successfully ..', $job);
            else
                return Helpers::returnJsonResponse(false, 'Error Creating Job ..', null);
        }
        else
            return Helpers::returnJsonResponse(false, 'Company for this job not found ..', null);
    }

    /**
     * Display the specified job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Request $request)
    {

          $validator = Validator::make($request->all(), [
            'job_id' => 'required'
        ]);
         if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs     ...', null );


         
        $job = $this->jobRepository->findWithoutFail($request->job_id);
        if (!is_null($job) )
            return Helpers::returnJsonResponse(true, 'job found Successfully ..', $job);
        else
            return Helpers::returnJsonResponse(false, 'job not found ..', null);

    }

     
    public function update($id, Request $request)
    {
        $job = $this->jobRepository->findWithoutFail($id);
        $inputs = $request->all();
        if (!empty($job)){

            if ($job = $this->jobRepository->update($inputs, $id))
                return Helpers::returnJsonResponse(true,'job updated successfully ..', $job);
            else
                return Helpers::returnJsonResponse(false, 'error updating job ..', null);

        }else{
            return Helpers::returnJsonResponse(false, 'job not existed .. ', null);
        }
    }

    /**
     * Remove the specified job from storage.
     *
     * @param  int $id
     *
     * @return Response
     */

        public function delete($id)
        {
            $job = $this->jobRepository->findWithoutFail($id);

            if (!empty($job)){

                if ($job = $this->jobRepository->delete($id))
                    return Helpers::returnJsonResponse(true,'job deleted ..', null);
                else
                    return Helpers::returnJsonResponse(false,'error deleting job ..',null);

            }
            else
                return Helpers::returnJsonResponse(false,'job not existed',null);
        }

        public function Jobs_in_company($company_id)
        {

        }

}
