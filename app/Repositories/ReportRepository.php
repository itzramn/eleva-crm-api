<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function getAllUsers()
    {
        try {
            return DB::select('CALL sp_get_users()');
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getAllProspects($userId, $developmentId)
    {
        try {
            return DB::select('CALL sp_get_prospects(?, ?)', [$userId, $developmentId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getFountainProspects($developmentId, $userId)
    {
        try {
            return DB::select('CALL sp_get_fountain_prospects(?, ?)', [$developmentId, $userId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getHistoryChangesMarketing($startDate, $endDate)
    {
        try {
            return DB::select('CALL sp_get_history_changes_marketing(?, ?)', [$startDate, $endDate]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function findProspectsReport($from, $to)
    {
        try {
            return DB::select('CALL sp_find_prospects_report(?, ?)', [$from, $to]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
