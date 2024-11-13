<?php

namespace App\Services;

use App\Repositories\ZapierRepository;

class ZapierService
{
    protected $zapierRepository;

    public function __construct(ZapierRepository $zapierRepository)
    {
        $this->zapierRepository = $zapierRepository;
    }

    public function findZapier($statusId)
    {
        return $this->zapierRepository->findZapier($statusId);
    }

    public function zapierReport($statusId)
    {
        return $this->zapierRepository->ZapierReport($statusId);
    }

    public function submitLandingInfo($data)
    {
        return $this->zapierRepository->submitLandingInfo(
            $data['name'],
            $data['lastName'],
            $data['telephone'],
            $data['email'],
            $data['comments'],
            $data['utm_source'],
            $data['utm_medium'],
            $data['utm_campaign'],
            $data['utm_term'],
            $data['utm_content']
        );
    }
}
