<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ReasonService;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    protected $reasonService;

    public function __construct(ReasonService $reasonService)
    {
        $this->reasonService = $reasonService;
    }

    public function index()
    {
        $result =
            $this->reasonService->getAllReasons();

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron motivos',
                'status' => 404
            ], 404);

            return response()->json($result, 200);
        }
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'reasonName' => 'required',
        ]);

        $result = $this->reasonService->createReason($validated['reasonName']);

        if (!$result) {
            return response()->json([
                'message' => 'El motivo ya existe',
                'status' => 409
            ], 409);
        }

        return response()->json([
            'message' => 'Motivo creado correctamente',
            'status' => 201
        ], 201);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'reasonName' => 'required',
            'reasonId' => 'required',
        ]);

        $result = $this->reasonService->updateReason(
            $validated['reasonName'],
            $validated['reasonId']
        );

        if (!$result) {
            return response()->json([
                'message' => 'No se pudo actualizar el motivo',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Motivo actualizado correctamente',
            'status' => 200
        ], 200);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'reasonId' => 'required',
        ]);

        $result = $this->reasonService->deleteReason($validated['reasonId']);

        if (!$result) {
            return response()->json([
                'message' => 'Error al eliminar el motivo',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Motivo eliminado correctamente',
            'status' => 200
        ], 200);
    }
}
