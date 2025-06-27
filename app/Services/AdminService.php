<?php

namespace App\Services;

use App\Repositories\AdminRepository;

class AdminService
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getTotalJobWithList()
    {
        return $this->adminRepository->getTotalJobAndList();
    }


    public function getTotalCandidateWithList()
    {
        return $this->adminRepository->getTotalCandidateAndList();
    }

    public function getTotalEmployerWithList()
    {
        return $this->adminRepository->getTotalEmployerAndList();
    }

    public function getTotalApplicationsAndJobList()
    {
        return $this->adminRepository->getTotalApplicationsWithJobList();
    }
}
