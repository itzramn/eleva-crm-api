<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ChannelService;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    protected $channelService;

    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
    }

    public function index()
    {
        $result = $this->channelService->getAllChannels();

        if (empty($result)) {
            return response()->json([
                'message' => 'Canales no encontrados',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'nameChannel' => 'required',
            'backgroundColor' => 'required',
            'textColor' => 'required',
        ]);

        $result = $this->channelService->createChannel(
            $validated['nameChannel'],
            $validated['backgroundColor'],
            $validated['textColor']
        );

        if (!$result) {
            return response()->json([
                'message' => 'El canal ya existe',
                'status' => 409
            ], 409);
        }

        return response()->json([
            'message' => 'Canal creado correctamente',
            'status ' => 201
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'channelId' => 'required',
            'nameChannel' => 'required',
            'backgroundColor' => 'required',
            'textColor' => 'required',
        ]);

        $result = $this->channelService->updateChannel(
            $validated['channelId'],
            $validated['nameChannel'],
            $validated['backgroundColor'],
            $validated['textColor']
        );

        if (!$result) {
            return response()->json([
                'message' => 'Error al actualizar el canal',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Canal actualizado correctamente',
            'status' => 200
        ], 200);
    }

    public function destroy(Request $request)
    {
        $validated = $request->valida([
            'channelId' => 'required',
        ]);

        $result = $this->channelService->deleteChannel($validated['channelId']);

        if (!$result) {
            return response()->json([
                'message' => 'Error al eliminar el canal',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Canal eliminado correctamente',
            'status' => 200
        ], 200);
    }
}
