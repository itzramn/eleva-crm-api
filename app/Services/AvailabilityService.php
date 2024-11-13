<?php

namespace App\Services;

use App\Repositories\AvailabilityRepository;

class AvailabilityService
{
    protected $availabilityRepository;

    public function __construct(AvailabilityRepository $availabilityRepository)
    {
        $this->availabilityRepository =
            $availabilityRepository;
    }

    public function getDepartments($developmentId)
    {
        return
            $this->availabilityRepository->getDepartments($developmentId);
    }

    public function updateDepartment(
        $developmentId,
        $price,
        $status,
        $PreSale
    ) {
        return
            $this->availabilityRepository->updateDepartment(
                $developmentId,
                $price,
                $status,
                $PreSale
            );
    }
}
