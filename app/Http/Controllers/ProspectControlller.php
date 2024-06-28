<?php

namespace App\Http\Controllers;

use App\Services\ProspectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProspectControlller extends Controller
{
    protected $prospectService;

    public function __construct(ProspectService $prospectService)
    {
        $this->prospectService = $prospectService;
    }

    public function index(Request $request)
    {

        $validator =Validator::make($request->all(), [
            'userId' => 'required',
            'developmentId' => 'required',
        ])->validate();

        $prospects = $this->prospectService->getAllProspects(
            $validator['userId'],
            $validator['developmentId']
        );

        return response()->json($prospects, 200);
    }

    public function show($id)
    {
        $prospect = $this->prospectService->getProspect($id);

        if(!$prospect) {
            $data = [
                'message' => 'Prospecto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        return response()->json($prospect, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'present',
            'budget' => 'present',
            'comments' => 'present',
            'interest' => 'present',
            'origin' => 'required',
            'otherOrigin' => 'present',
            'isBroker' => 'required',
            'dueDate' => 'required',
            'approve' => 'required',
            'important' => 'required',
            'qualification' => 'required',
            'developmentId' => 'required',
            'stageId' => 'required',
            'postpone' => 'present',
            'registerId' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $validatedData = $validator->validated();

        $existingProspect = $this->prospectService->findProspect(
        $validatedData['email'],
        $validatedData['phone'],
        $validatedData['developmentId'],
        );

        if ($existingProspect) {
            $data = [
                'message' => 'El prospecto ya existe',
                'status' => 409
            ];
            return response()->json($data, 409);
        }

        $prospect = $this->prospectService->createProspect(
            $validatedData['userId'],
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['phone'],
            $validatedData['city'],
            $validatedData['budget'],
            $validatedData['comments'],
            $validatedData['interest'],
            $validatedData['origin'],
            $validatedData['otherOrigin'],
            $validatedData['isBroker'],
            $validatedData['dueDate'],
            $validatedData['approve'],
            $validatedData['important'],
            $validatedData['qualification'],
            $validatedData['developmentId'],
            $validatedData['stageId'],
            $validatedData['postpone'],
            $validatedData['registerId']
        );

        if(!$prospect) {
            $data = [
                'message' => 'Error al crear el prospecto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Prospecto creado correctamente',
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $prospect = $this->prospectService->getProspect($id);

        if(!$prospect) {
            $data = [
                'message' => 'Prospecto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'present',
            'developmentId' => 'required',
            'interest' => 'present',
            'qualification' => 'required',
            'origin' => 'required',
            'stageId' => 'required',
            'comments' => 'present',
            'editDate' => 'required',
            'editorId' => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $validatedData = $validator->validated();

        $existingProspect = $this->prospectService->findProspect(
            $validatedData['email'],
            $validatedData['phone'],
            $validatedData['developmentId']
        );

        if ($existingProspect && $existingProspect->id != $id) {
            $data = [
                'message' => 'Otro prospecto con el mismo correo o teléfono ya existe en el mismo desarrollo',
                'status' => 409
            ];
            return response()->json($data, 409);
        }

        $updated = $this->prospectService->updateProspect(
            $id,
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['phone'],
            $validatedData['city'],
            $validatedData['interest'],
            $validatedData['qualification'],
            $validatedData['origin'],
            $validatedData['stageId'],
            $validatedData['comments'],
            $validatedData['editDate'],
            $validatedData['editorId']
        );

        if(!$updated) {
            $data = [
                'message' => 'Error al actualizar el prospecto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Prospecto actualizado correctamente',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $prospect = $this->prospectService->getProspect($id);

        if(!$prospect) {
            $data = [
                'message' => 'Prospecto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $deleted = $this->prospectService->deleteProspect($id);

        if(!$deleted) {
            $data = [
                'message' => 'Error al eliminar el prospecto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Prospecto eliminado correctamente',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
