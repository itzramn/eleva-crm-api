<?php

namespace App\Services;

use App\Repositories\FunnelRepository;

class FunnelService
{
    protected $funnelRepository;

    public function __construct(FunnelRepository $funnelRepository)
    {
        $this->funnelRepository = $funnelRepository;
    }

    public function getAllFunnels()
    {
        return
            $this->funnelRepository->getAllFunnels();
    }

    public function createFunnel($funnelName)
    {
        return
            $this->funnelRepository->createFunnel($funnelName);
    }

    public function updateFunnel(
        $funnelId,
        $funnelName,
        $orderFunnel
    ) {
        return $this->funnelRepository->updateFunnel(
            $funnelId,
            $funnelName,
            $orderFunnel
        );
    }

    public function deleteFunnel($funnelId)
    {
        return $this->funnelRepository->deleteFunnel($funnelId);
    }

    public function getFunnelAction($funnelId)
    {
        return $this->funnelRepository->getFunnelAction($funnelId);
    }

    public function updateFunnelAction(
        $funnelId,
        $subject,
        $body
    ) {
        return $this->funnelRepository->updateFunnelAction(
            $funnelId,
            $subject,
            $body
        );
    }
}
