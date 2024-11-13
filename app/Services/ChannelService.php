<?php

namespace App\Services;

use App\Repositories\ChannelRepository;

class ChannelService
{
    protected $channelRepository;

    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function getAllChannels()
    {
        return
            $this->channelRepository->getAllChannels();
    }

    public function createChannel(
        $nameChannel,
        $backgroundColor,
        $textColor
    ) {
        return
            $this->channelRepository->createChannel(
                $nameChannel,
                $backgroundColor,
                $textColor
            );
    }

    public function updateChannel(
        $channelId,
        $nameChannel,
        $backgroundColor,
        $textColor
    ) {
        return
            $this->channelRepository->updateChannel(
                $channelId,
                $nameChannel,
                $backgroundColor,
                $textColor
            );
    }

    public function deleteChannel($channelId)
    {
        return
            $this->channelRepository->deleteChannel($channelId);
    }
}
