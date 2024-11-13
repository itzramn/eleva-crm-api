<?php

namespace App\Services;

use App\Repositories\DevelopmentRepository;

class DevelopmentService
{
    protected $developmentRepository;

    public function __construct(DevelopmentRepository $developmentRepository)
    {
        $this->developmentRepository =
            $developmentRepository;
    }

    public function getAllDevelopments()
    {
        return
            $this->developmentRepository->getAllDevelopments();
    }

    public function getDevelopment($developmentId)
    {
        return
            $this->developmentRepository->getDevelopment($developmentId);
    }

    public function updateDevelopments(
        $developmentId,
        $body,
        $subject
    ) {
        return
            $this->developmentRepository->updateDevelopments(
                $developmentId,
                $body,
                $subject
            );
    }

    public function deleteDevelopments($developmentId)
    {
        return
            $this->developmentRepository->deleteDevelopments($developmentId);
    }
}
