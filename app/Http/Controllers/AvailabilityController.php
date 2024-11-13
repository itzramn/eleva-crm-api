<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    protected $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    public function show(Request $request)
    {
        $validated = $request->validate([
            'developmentId' => 'required'
        ]);

        $result = $this->availabilityService->getDepartments($validated['developmentId']);

        if (!$result) {
            return response()->json([
                'message' => 'Desarrollos no encontrados',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'departmentId' => 'required',
            'price' => 'required',
            'status' => 'required',
            'preSale' => 'required'
        ]);

        $result =
            $this->availabilityService->updateDepartment(
                $validated['departmentId'],
                $validated['price'],
                $validated['status'],
                $validated['preSale']
            );

        if (!$result) {
            return response()->json([
                'message' => 'Error al actualizar el departamento',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Departamento actualizado correctamente',
            'status' => 200
        ], 200);
    }
}
