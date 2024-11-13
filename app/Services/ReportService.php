<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService
{
    protected $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getAllUsers()
    {
        return $this->reportRepository->getAllUsers();
    }

    public function getAllProspects($userId, $developmentId)
    {
        return $this->reportRepository->getAllProspects($userId, $developmentId);
    }

    public function getFountainProspects($developmentId, $userId)
    {
        return $this->reportRepository->getFountainProspects($developmentId, $userId);
    }

    public function getHistoryChangesMarketing($startDate, $endDate)
    {
        return $this->reportRepository->getHistoryChangesMarketing($startDate, $endDate);
    }

    public function findProspectsReport($from, $to)
    {
        return $this->reportRepository->findProspectsReport($from, $to);
    }
}
