<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReasonRepository
{
    public function getAllReasons()
    {
        try {
            return DB::select('CALL sp_get_reasons()');
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function createReason($reasonName)
    {
        try {
            DB::select(
                'CALL sp_create_reason(?)',
                [$reasonName]
            );
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false; //Indicates that the reason already exists.
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateReason(
        $reasonName,
        $reasonId
    ) {
        try {
            DB::select(
                'CALL sp_update_reason(?,?)',
                [
                    $reasonName,
                    $reasonId
                ]
            );
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function deleteReason($reasonId)
    {
        try {
            DB::select(
                'CALL sp_delete_reason(?)',
                [$reasonId]
            );
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
