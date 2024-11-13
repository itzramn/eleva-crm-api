<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AvailabilityRepository
{
    public function getDepartments($developmentId)
    {
        try {
            return DB::select('CALL sp_get_departments(?)', [$developmentId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateDepartment(
        $departmentId,
        $price,
        $status,
        $preSale
    ) {
        try {
            DB::select('CALL sp_update_department(?,?,?,?)', [
                $departmentId,
                $price,
                $status,
                $preSale
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
