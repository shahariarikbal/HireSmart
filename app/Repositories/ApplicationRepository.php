<?php

namespace App\Repositories;

use App\Models\Application;
use App\Models\JobList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApplicationRepository
{
    public function getAllJob()
    {
        $jobs = Cache::remember('recent_job', now()->addMinutes(5), function(){
            return JobList::with('user')->isActive()->latest()->paginate(20);
        });
        return $jobs;
    }

    public function filterJobs($filters = [])
    {
        return JobList::query()
        ->when($filters['keyword'], fn($q) => $q->where('title', 'ilike', "%{$filters['keyword']}%"))
        ->when($filters['location'], fn($q) => $q->where('location', $filters['location']))
        ->isActive()
        ->latest()
        ->get();
    }


    public function apply($data, $id)
    {
        $job = JobList::findOrFail($id);

        return Application::create([
            'user_id' => JWTAuth::user()->id,
            'job_list_id' => $job->id,
            'cover_letter' => $data['cover_letter'],
            'applied_at' => Carbon::now(),
        ]);
    }
}