<?php

namespace App\Http\Controllers;

use App\Services\DevelopmentService;
use Illuminate\Http\Request;

class DevelopmentController extends Controller
{
    protected $DevelopmentService;

    public function __construct(DevelopmentService $DevelopmentService)
    {
        $this->DevelopmentService = $DevelopmentService;
    }

    public function index()
    {

        $developments =
            $this->DevelopmentService->getAllDevelopments();

        if (empty($developments)) {

            return response()->json([
                'message' => 'Desarrollos no encontrados',
                'status' => 404
            ], 404);
        }

        return response()->json($developments, 200);
    }

    public function show(Request $request)
    {
        $validated = $request->validate([
            'developmentId' => 'required',
        ]);

        $result = $this->DevelopmentService->getDevelopment($validated['developmentId']);

        if (!$result) {
            return response()->json([
                'message' => 'Desarrollo no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function updateAction(Request $request)
    {
        $validated = $request->validate([
            'developmentId' => 'required',
            'body' => 'present',
            'subject' => 'present',
        ]);

        $result = $this->DevelopmentService->updateDevelopments(
            $validated['developmentId'],
            $validated['body'],
            $validated['subject']
        );

        if (!$result) {
            return response()->json([
                'message' => 'Error al actualizar el desarrollo',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Desarrollo actualizado correctamente',
            'status' => 200
        ], 200);
    }
}
