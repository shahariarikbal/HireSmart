<?php

namespace App\Repositories;

use App\Models\JobList;
use App\Services\ImageService;
use Tymon\JWTAuth\Facades\JWTAuth;

class JobListRepository
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getJobList()
    {
        return $job_lists = JobList::with('user')->authUser()->latest()->get();
    }

    public function getJobApplications($id)
    {
        return JobList::with('applications')
        ->where('id', $id)
        ->where('user_id', JWTAuth::user()->id)
        ->latest()
        ->get();
    }

    public function store($data)
    {
        try {
            $job_list = JobList::create([
            'title' => $data['title'],
            'job_type' => $data['job_type'],
            'experience_level' => $data['experience_level'],
            'is_active' => $data['is_active'],
            'image' => $this->imageService->uploadImage($data['image'], 'images/joblist'),
            'user_id' => JWTAuth::user()->id,
            'description' => $data['description'],
            'location' => $data['location'],
            'salary_min' => $data['salary_min'],
            'salary_max' => $data['salary_max'],
            ]);

            return $job_list;
        } catch (\Exception $e) {
            \Log::error('JobList creation failed', [
            'error' => $e->getMessage(),
            'data' => $data
            ]);
            throw $e;
        }
    }

    public function update($data, $id)
    {
        try {
            $job_list = JobList::findOrFail($id);

            $image = $this->imageService->updateImage(
                $data['image'] ?? null,
                'images/joblist',
                $job_list->image
            );

            $job_list->update([
                'title' => $data['title'],
                'job_type' => $data['job_type'],
                'experience_level' => $data['experience_level'],
                'is_active' => $data['is_active'],
                'image' => $image,
                'user_id' => JWTAuth::user()->id,
                'description' => $data['description'],
                'location' => $data['location'],
                'salary_min' => $data['salary_min'],
                'salary_max' => $data['salary_max'],
            ]);

            return $job_list;
        } catch (\Exception $e) {
            \Log::error('JobList update failed', [
                'error' => $e->getMessage(),
                'data' => $data,
                'id' => $id
            ]);
            throw $e;
        }
    }

    public function show($id)
    {
        return JobList::findOrFail($id);
    }


    public function delete($id)
    {
        $job_list = JobList::findOrFail($id);
        if ($job_list->avatar && file_exists(public_path($job_list->avatar))) {
            unlink(public_path($job_list->avatar));
        }
        $job_list->delete();
        return true;
    }
}