<?php

namespace App\Services;

use App\Repositories\BrokerRepository;

class BrokerService
{
    protected $brokerRepository;

    public function __construct(BrokerRepository $brokerRepository)
    {
        $this->brokerRepository = $brokerRepository;
    }

    public function findBrokers($userId)
    {
        return $this->brokerRepository->findBrokers($userId);
    }

    public function findBrokersReports(
        $userId,
        $from,
        $to
    ) {
        return $this->brokerRepository->findBrokersReport(
            $userId,
            $from,
            $to
        );
    }
}
