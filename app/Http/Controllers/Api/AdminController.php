<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function employerCountAndList()
    {
        try{
            $employers = $this->adminService->getTotalEmployerWithList();

            return response()->json([
                'status' => 200,
                'data' => $employers,
                'message' => 'Total number of employers and their list retrieved successfully'
            ]);
        }catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function candidateCountAndList()
    {
        try{
            $candidates = $this->adminService->getTotalCandidateWithList();

            return response()->json([
                'status' => 200,
                'data' => $candidates,
                'message' => 'Total number of candidates and their list retrieved successfully'
            ]);
        }catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function applicationCountAndList()
    {
        try{
            $applications = $this->adminService->getTotalApplicationsAndJobList();
            return response()->json([
                'status' => 200,
                'data' => $applications,
                'message' => 'Total number of job applications and their list retrieved successfully'
            ]);
        }catch(Exception $e){
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
