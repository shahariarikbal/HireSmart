<?php

namespace App\Services;

use App\Repositories\JobListRepository;

class JobListService
{
    protected $jobListRepository;
    /**
     * JobListService constructor.
     *
     * @param JobListRepository $jobListRepository
     */
    public function __construct(JobListRepository $jobListRepository)
    {
        $this->jobListRepository = $jobListRepository;
    }


    public function getJobList()
    {
        return $this->jobListRepository->getJobList();
    }

    public function store($data)
    {
        return $this->jobListRepository->store($data);
    }

    public function update($data, $id)
    {
        return $this->jobListRepository->update($data, $id);
    }

    public function show($id)
    {
        return $this->jobListRepository->show($id);
    }

    public function delete($id)
    {
        return $this->jobListRepository->delete($id);
    }
}
