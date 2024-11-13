<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ZapierService;
use Illuminate\Http\Request;

class ZapierController extends Controller
{
    protected $zapierService;

    public function __construct(ZapierService $zapierService)
    {
        $this->zapierService = $zapierService;
    }

    public function findZapier(Request $request)
    {
        $validated = $request->validate([
            'statusId' => 'required',
        ]);

        $result = $this->zapierService->findZapier($validated['statusId']);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function zapierReport(Request $request)
    {
        $validated = $request->validate([
            'statusId' => 'required',
        ]);

        $result = $this->zapierService->zapierReport($validated['statusId']);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron registros',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function landingSubmitInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'comments' => 'required',
            'utm_source' => 'required',
            'utm_medium' => 'required',
            'utm_campaign' => 'required',
            'utm_term' => 'required',
            'utm_content' => 'required',
        ]);

        $result = $this->zapierService->submitLandingInfo($validated);

        if (!$result) {
            return response()->json([
                'message' => 'No se pudo registrar la información',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Información registrada correctamente',
            'status' => 200
        ], 200);
    }
}
