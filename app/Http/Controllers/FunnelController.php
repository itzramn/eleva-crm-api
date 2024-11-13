<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\FunnelService;
use Illuminate\Http\Request;

class FunnelController extends Controller
{
    protected $funnelService;

    public function __construct(FunnelService $funnelService)
    {
        $this->funnelService = $funnelService;
    }

    public function index()
    {
        $result = $this->funnelService->getAllFunnels();

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron embudos',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'funnelName' => 'required',
        ]);

        $result = $this->funnelService->createFunnel($validated['funnelName']);

        if (!$result) {
            return response()->json([
                'message' => 'El embudo ya existe',
                'status' => 409
            ], 409);
        }

        return response()->json([
            'message' => 'Embudo creado correctamente',
            'status' => 201
        ], 201);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'funnelId' => 'required',
            'funnelName' => 'required',
            'orderFunnel' => 'required',
        ]);

        $result = $this->funnelService->updateFunnel(
            $validated['funnelId'],
            $validated['funnelName'],
            $validated['orderFunnel']
        );

        if (!$result) {
            return response()->json([
                'message' => 'No se pudo actualizar el embudo',
                'status' => 500
            ]);
        }

        return response()->json([
            'message' => 'Embudo actualizado correctamente',
            'status' => 200
        ]);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'funnelId' => 'required',
        ]);

        $result = $this->funnelService->deleteFunnel($validated['funnelId']);

        if (!$result) {
            return response()->json([
                'message' => 'No se pudo eliminar el embudo',
                'status' => 500
            ]);
        }

        return response()->json([
            'message' => 'Embudo eliminado correctamente',
            'status' => 200
        ]);
    }

    public function getAction(Request $request)
    {
        $validated = $request(['funnelId' => 'required']);

        $result = $this->funnelService->getFunnelAction($validated['funnelId']);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontró la acción del embudo',
                'status' => 400
            ]);
        }

        return response()->json($result, 200);
    }

    public function updateAction(Request $request)
    {
        $validated = $request->validate([
            'funnelId' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        $result = $this->funnelService->updateFunnelAction(
            $validated['funnelId'],
            $validated['subject'],
            $validated['body']
        );

        if (!$result) {
            return response()->json([
                'message' => 'No se pudo actualizar la acción del embudo',
                'status' => 500
            ]);
        }

        return response()->json([
            'message' => 'Acción del embudo actualizada correctamente',
            'status' => 200
        ]);
    }
}
