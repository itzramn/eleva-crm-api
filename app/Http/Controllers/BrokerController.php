<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\BrokerService;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    protected $brokerService;

    public function __construct(BrokerService $brokerService)
    {
        $this->brokerService = $brokerService;
    }

    public function findBrokers(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required',
        ]);

        $result = $this->brokerService->findBrokers($validated['userId']);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron brokers',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }

    public function findBrokersReport(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        $result = $this->brokerService->findBrokersReports(
            $validated['userId'],
            $validated['from'],
            $validated['to']
        );

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron brokers',
                'status' => 404
            ], 404);
        }

        return response()->json($result, 200);
    }
}
