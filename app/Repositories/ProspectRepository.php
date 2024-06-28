<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProspectRepository
{
    public function getAllProspects($userId, $developmentId)
    {
        try {
            return DB::select('CALL sp_get_prospects(?, ?)', [$userId, $developmentId]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function getProspect($id)
    {
        try {
            return DB::select('CALL sp_get_prospect_by_id(?)', [$id]);
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function createProspect(
        $userId,
        $name,
        $email,
        $phone,
        $city,
        $budget,
        $comments,
        $interest,
        $origin,
        $otherOrigin,
        $isBroker,
        $dueDate,
        $approve,
        $important,
        $qualification,
        $developmentId,
        $stageId,
        $postpone,
        $registerId
    ){
        try {
            DB::select('CALL sp_create_prospect(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                $userId,
                $name,
                $email,
                $phone,
                $city,
                $budget,
                $comments,
                $interest,
                $origin,
                $otherOrigin,
                $isBroker,
                $dueDate,
                $approve,
                $important,
                $qualification,
                $developmentId,
                $stageId,
                $postpone,
                $registerId
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function updateProspect(
        $id,
        $name,
        $email,
        $phone,
        $city,
        $interest,
        $qualification,
        $origin,
        $stageId,
        $comments,
        $editDate,
        $editorId
    ){
        try {
            DB::select('CALL sp_update_prospect(?,?,?,?,?,?,?,?,?,?,?,?)', [
                $id,
                $name,
                $email,
                $phone,
                $city,
                $interest,
                $qualification,
                $origin,
                $stageId,
                $comments,
                $editDate,
                $editorId
            ]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function deleteProspect($id)
    {
        try {
            DB::select('CALL sp_delete_prospect(?)', [$id]);
            return true;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }

    public function findProspect($email, $telefono, $id_desarrollo)
    {
        try {
            $result = DB::select('CALL sp_find_prospect(?, ?, ?)', [$email, $telefono, $id_desarrollo]);
            return count($result) > 0 ? $result[0] : null;
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return false;
        }
    }
}
