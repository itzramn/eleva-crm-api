<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FunnelRepository
{
    public function getAllFunnels()
    {
        try {
            return DB::select('CALL sp_get_funnels()');
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function createFunnel($funnelName)
    {
        try {
            DB::select('CALL sp_create_funnel(?)', [$funnelName]);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            error_log($e->getMessage());
            return false; // Indicates that the funnel already exists
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateFunnel(
        $funnelId,
        $funnelName,
        $orderFunnel
    ) {
        try {
            DB::select('CALL sp_update_funnel(?,?,?)', [
                $funnelId,
                $funnelName,
                $orderFunnel
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function deleteFunnel($funnelId)
    {
        try {
            DB::select('CALL sp_delete_funnel(?)', [$funnelId]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getFunnelAction($funnelId)
    {
        try {
            $result = DB::select('CALL sp_get_funnel_action(?)', [$funnelId]);
            return count($result) > 0 ? $result[0] : null;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateFunnelAction(
        $funnelId,
        $subject,
        $body
    ) {
        try {
            DB::select('CALL sp_update_funnel_action(?,?,?)', [
                $funnelId,
                $subject,
                $body
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
