<?php

namespace App\Services;

use App\Repositories\RecoveryRepository;

class RecoveryService
{
    protected $recoveryRepository;

    public function __construct(RecoveryRepository $recoveryRepository)
    {
        $this->recoveryRepository = $recoveryRepository;
    }

    public function getAllRecoveryTemplates()
    {
        return
            $this->recoveryRepository->getAllRecoveryTemplates();
    }

    public function updateRecoveryTemplate($emailId, $subjectEmail)
    {
        return
            $this->recoveryRepository->updateRecoveryTemplate($emailId, $subjectEmail);
    }
}
