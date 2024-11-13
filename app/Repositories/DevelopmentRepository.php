<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DevelopmentRepository
{
    public function getAllDevelopments()
    {
        try {
            return DB::select('CALL sp_get_developments()');
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getDevelopment($developmentId)
    {
        try {
            return DB::select('CALL sp_get_development_by_id(?)', [$developmentId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateDevelopments(
        $developmentId,
        $body,
        $subject,
    ) {
        try {
            DB::select(
                'CALL sp_update_development(?,?,?)',
                [
                    $developmentId,
                    $body,
                    $subject,
                ]
            );
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function deleteDevelopments($developmentId)
    {
        try {
            DB::select('CALL sp_delete_development(?)', [$developmentId]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
