<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class BrokerRepository
{
    public function findBrokers($userId)
    {
        try {
            return DB::select('CALL sp_get_brokers(?)', [$userId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function findBrokersReport(
        $userId,
        $from,
        $to
    ) {
        try {
            return DB::select('CALL sp_get_brokers_report(?,?,?)', [
                $userId,
                $from,
                $to
            ]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
