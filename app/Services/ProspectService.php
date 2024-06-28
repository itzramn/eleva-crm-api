<?php

namespace App\Services;

use App\Repositories\ProspectRepository;

class ProspectService
{
    protected $prospectRepository;

    public function __construct(ProspectRepository $prospectRepository)
    {
        $this->prospectRepository = $prospectRepository;
    }

    public function getAllProspects($userId, $developmentId)
    {
        return $this->prospectRepository->getAllProspects($userId, $developmentId);
    }

    public function getProspect($id)
    {
        return $this->prospectRepository->getProspect($id);
    }

    public function createProspect(
        $userId,
        $name,
        $email,
        $phone,
        $city,
        $budget,
        $comments,
        $interest,
        $origin,
        $otherOrigin,
        $isBroker,
        $dueDate,
        $approve,
        $important,
        $qualification,
        $developmentId,
        $stageId,
        $postpone,
        $registerId
    ){
        return $this->prospectRepository->createProspect(
            $userId,
            $name,
            $email,
            $phone,
            $city,
            $budget,
            $comments,
            $interest,
            $origin,
            $otherOrigin,
            $isBroker,
            $dueDate,
            $approve,
            $important,
            $qualification,
            $developmentId,
            $stageId,
            $postpone,
            $registerId
        );
    }

    public function updateProspect(
        $id,
        $name,
        $email,
        $phone,
        $city,
        $interest,
        $qualification,
        $origin,
        $stageId,
        $comments,
        $editDate,
        $editorId

    ){
        return $this->prospectRepository->updateProspect(
            $id,
            $name,
            $email,
            $phone,
            $city,
            $interest,
            $qualification,
            $origin,
            $stageId,
            $comments,
            $editDate,
            $editorId
        );
    }

    public function deleteProspect($id)
    {
        return $this->prospectRepository->deleteProspect($id);
    }

    public function findProspect($email, $telefono, $id_desarrollo)
    {
        return $this->prospectRepository->findProspect($email, $telefono, $id_desarrollo);
    }
}
