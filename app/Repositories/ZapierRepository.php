<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ZapierRepository
{
    public function findZapier($statusId)
    {
        try {
            return DB::select('CALL sp_get_find_zapier(?)', [$statusId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function zapierReport($statusId)
    {
        try {
            return DB::select('CALL sp_get_zapier_report(?)', [$statusId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function submitLandingInfo(
        $name,
        $lastName,
        $telephone,
        $email,
        $comments,
        $utm_source,
        $utm_medium,
        $utm_campaign,
        $utm_term,
        $utm_content
    ) {
        try {
            DB::select('CALL sp_submit_landing_info(?,?,?,?,?,?,?,?,?,?)', [
                $name,
                $lastName,
                $telephone,
                $email,
                $comments,
                $utm_source,
                $utm_medium,
                $utm_campaign,
                $utm_term,
                $utm_content
            ]);
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            error_log($e->getMessage());
            return false; // Indicates that the zapier already exists
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
