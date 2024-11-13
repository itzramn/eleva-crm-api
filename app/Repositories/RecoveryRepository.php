<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RecoveryRepository
{
    public function getAllRecoveryTemplates()
    {
        try {
            return DB::select('CALL sp_get_recovery_templates()');
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateRecoveryTemplate(
        $emailId,
        $subjectEmail
    ) {
        try {
            DB::select('CALL sp_update_recovery_template(?,?)', [
                $emailId,
                $subjectEmail
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
