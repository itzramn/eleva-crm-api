<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\RecoveryService;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    protected $recoveryService;

    public function __construct(RecoveryService $recoveryService)
    {
        $this->recoveryService = $recoveryService;
    }

    public function index()
    {
        $result = $this->recoveryService->getAllRecoveryTemplates();

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron correos de recuperación',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'emailId' => 'required',
            'subjectEmail' => 'required',
        ]);

        $result = $this->recoveryService->updateRecoveryTemplate(
            $validated['emailId'],
            $validated['subjectEmail']
        );

        if (!$result) {
            return response()->json([
                'message' => 'No se pudo actualizar el correo de recuperación',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Correo de recuperación actualizado correctamente',
            'status' => 200
        ], 200);
    }
}
