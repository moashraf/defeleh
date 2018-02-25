<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatejobRequest;
use App\Http\Requests\UpdatejobRequest;
use App\Repositories\jobRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class mainjobsController extends AppBaseController
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
        $this->jobRepository->pushCriteria(new RequestCriteria($request));
        $jobs = $this->jobRepository->all();

        return view('main.jobs.index')
            ->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new job.
     *
     * @return Response
     */
    public function create()
    {


         $companies = company::where('ownerid', '=', Auth::id() )->get();
      return view('main.jobs.create')  ->with('companies', $companies);

     }

    /**
     * Store a newly created job in storage.
     *
     * @param CreatejobRequest $request
     *
     * @return Response
     */
    public function store(CreatejobRequest $request)
    {
        $input = $request->all();

        $job = $this->jobRepository->create($input);

        Flash::success('Job saved successfully.');

        return redirect(route('mainjobs.index'));
    }

    /**
     * Display the specified job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');
            return redirect(route('main.jobs.index'));
        }

        return view('main.jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified job.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified job in storage.
     *
     * @param  int              $id
     * @param UpdatejobRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatejobRequest $request)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        $job = $this->jobRepository->update($request->all(), $id);

        Flash::success('Job updated successfully.');

        return redirect(route('jobs.index'));
    }

    /**
     * Remove the specified job from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $job = $this->jobRepository->findWithoutFail($id);

        if (empty($job)) {
            Flash::error('Job not found');

            return redirect(route('jobs.index'));
        }

        $this->jobRepository->delete($id);

        Flash::success('Job deleted successfully.');

        return redirect(route('jobs.index'));
    }

  public function     Jobs_in_company($company_id)
    {


 $jobs = job::where('companyid', '=',$company_id )->paginate(2);
   return view('main.jobs.index')  ->with('jobs', $jobs);
    }

}
