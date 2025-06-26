<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use Exception;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function getAllJobList()
    {
        $get_all_jobs = $this->applicationService->getAllJob();
        return response()->json([
            'status' => 200,
            'data' => $get_all_jobs
        ]);
    }

    public function jobFiltering(Request $request)
    {
        $filters = $request->only(['keyword', 'location']);
        $jobs = $this->applicationService->filterJobs($filters);
        return response()->json([
            'status' => 200,
            'data' => $jobs
        ]);
    }

    public function jobApply(Request $request, $id)
    {
        try{
            $validatedData = $request->only(['cover_letter']);

            $apply = $this->applicationService->jobApply($validatedData, $id);
            return response()->json([
                'status' => 201,
                'data' => $apply,
                'message' => 'Your application has been submitted'
            ]);
        }catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
        
    }
}
