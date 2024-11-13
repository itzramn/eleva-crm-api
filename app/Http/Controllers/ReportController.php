<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function users()
    {
        $result = $this->reportService->getAllUsers();

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron usuarios',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function prospects(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required',
            'developmentId' => 'required',
        ]);

        $result = $this->reportService->getAllProspects(
            $validated['userId'],
            $validated['developmentId'],
        );

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron prospectos',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function fountainProspects(Request $request)
    {
        $validated = $request->validate([
            'developmentId' => 'required',
            'userId' => 'required',
        ]);

        $result = $this->reportService->getFountainProspects(
            $validated['developmentId'],
            $validated['userId']
        );

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron fuentes',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function historyChangesMarketing(Request $request)
    {
        $validated = $request->validate([
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        $result = $this->reportService->getHistoryChangesMarketing(
            $validated['startDate'],
            $validated['endDate']
        );

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron cambios',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function findProspectsReport(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        $result = $this->reportService->findProspectsReport(
            $validated['from'],
            $validated['to']
        );

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron prospectos',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }
}
