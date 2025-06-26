<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;

class ApplicationService
{
    protected $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function getAllJob()
    {
        return $this->applicationRepository->getAllJob();
    }

    public function filterJobs(array $filters = [])
    {
        return $this->applicationRepository->filterJobs($filters);
    }

    public function jobApply($data, $id)
    {
        return $this->applicationRepository->apply($data, $id);
    }
}
