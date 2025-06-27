<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\JobList;
use App\Models\User;

class AdminRepository
{
    public function getTotalJobAndList()
    {
        $data = [
            'totalJobs' => JobList::count(),
            'jobLists' => JobList::latest()->get()
        ];

        return $data;
    }

    public function getTotalCandidateAndList()
    {
        $data = [
            'totalCandidate' => User::where('role', 'candidate')->count(),
            'candidateList' => User::where('role', 'candidate')->latest()->get(),
        ];

        return $data;
    }

    public function getTotalEmployerAndList()
    {
        $data = [
            'totalEmployer' => User::where('role', 'employer')->count(),
            'employerList' => User::where('role', 'employer')->latest()->get(),
        ];

        return $data;
    }

    public function getTotalApplicationsWithJobList()
    {
        $data = [
            'totalApplications' => Application::count(),
            'applicationsList' => Application::with(['jobList'])->latest()->get()
        ];

        return $data;
    }
}