<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Services\JobListService;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    protected $jobService;

    public function __construct(JobListService $jobService)
    {
        $this->jobService = $jobService;
    }


    public function getJobList()
    {
        $job_lists = $this->jobService->getJobList();
        return response()->json($job_lists, 200);
    }

    public function jobApplications($id)
    {
        $job_applications = $this->jobService->getJobApplications($id);
        return response()->json($job_applications, 200);
    }

    public function storeJob(JobStoreRequest $request)
    {
        $data = $request->validated();

        $job_list = $this->jobService->store($data);
        return response()->json($job_list, 201);
    }

    public function updateJob(JobUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $job_list = $this->jobService->update($data, $id);
        return response()->json($job_list, 200);
    }

    public function showJob($id)
    {
        $job_list = $this->jobService->show($id);
        return response()->json($job_list, 200);
    }

    public function deleteJob($id)
    {
        $this->jobService->delete($id);
        return response()->json(['message' => 'Job deleted successfully'], 200);
    }
}
