<?php

namespace App\Services;

use App\Repositories\ReasonRepository;

class ReasonService
{
    protected $reasonRepository;

    public function __construct(ReasonRepository $reasonRepository)
    {
        $this->reasonRepository = $reasonRepository;
    }

    public function getAllReasons()
    {
        return $this->reasonRepository->getAllReasons();
    }

    public function createReason($reasonName)
    {
        return $this->reasonRepository->createReason($reasonName);
    }

    public function updateReason(
        $reasonName,
        $reasonId
    ) {
        return $this->reasonRepository->updateReason(
            $reasonName,
            $reasonId
        );
    }

    public function deleteReason($reasonId)
    {
        return $this->reasonRepository->deleteReason($reasonId);
    }
}
