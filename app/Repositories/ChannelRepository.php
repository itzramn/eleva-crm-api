<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ChannelRepository
{
    public function getAllChannels()
    {
        try {
            return DB::select('CALL sp_get_channels()');
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function createChannel(
        $nameChannel,
        $backgroundColor,
        $textColor
    ) {
        try {
            DB::select(
                'CALL sp_create_channel(?,?,?)',
                [
                    $nameChannel,
                    $backgroundColor,
                    $textColor
                ]
            );
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            error_log($e->getMessage());
            return false; //Indicates that the channel already exists
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateChannel(
        $channelId,
        $nameChannel,
        $backgroundColor,
        $textColor
    ) {
        try {
            DB::select('CALL sp_update_channel(?,?,?,?)', [
                $channelId,
                $nameChannel,
                $backgroundColor,
                $textColor
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function deleteChannel($channelId)
    {
        try {
            DB::select('CALL sp_delete_channel(?)', [$channelId]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
