<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patrocinador;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class sponsorsController extends Controller
{
    public function crearPatrocinador(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'primer_nombre' => 'required|string|max:255',
                'segundo_nombre' => 'string|max:255',
                'primer_apellido' => 'required|string|max:255',
                'segundo_apellido' => 'string|max:255',
                'telefono' => 'required|numeric|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'status' => false,
                    'errors' => $validator->errors()
                ], Response::HTTP_BAD_REQUEST);
            }

            $patrocinadores = Patrocinador::create([
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'telefono' => $request->telefono,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'message' => 'okey',
            'status' => true,
            'patrocinador' => $patrocinadores,
        ], Response::HTTP_OK);
    }

    public function listarPatrocinadores()
    {
        try {
            $patrocinadores = Patrocinador::where('estado', 1)->get();
        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()-> json([
            'message' => 'Lista de patrocinadores obtenida',
            'status' => true,
            'patrocinador' => $patrocinadores,
        ], Response::HTTP_OK);
    }

    public function consultarPatrocinadores($id)
    {
        try {
            $patrocinadores = Patrocinador::find($id);
            if (!$patrocinadores) {
                return response()->json(['message' => 'Patrociandor no encontrado'], 404);
            }
            return response()->json($patrocinadores, Response::HTTP_OK);
        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editarPatrocinadores(Request $request, $id)
    {
        try {
            $patrocinadores = Patrocinador::find($id);
            if (!$patrocinadores) {
                return response()->json(['message' => 'Patrociandor no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'primer_nombre' => 'required|string|max:255',
                'segundo_nombre' => 'required|string|max:255',
                'primer_apellido' => 'required|string|max:255',
                'segundo_apellido' => 'required|string|max:255',
                'telefono' => 'required|numeric|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $patrocinadores->update($request->all());

            return response()->json([
                'message' => 'Patrociandor actualizado exitosamente',
                'status' => true,
                'Patrociandores' => $patrocinadores,
            ], Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function desactivarPatrocinador($id)
    {
        try {
            $patrocinador = Patrocinador::find($id);
            if (!$patrocinador) {
                return response()->json(['message' => 'Patrocinador no encontrado'], 404);
            }

            $patrocinador->desactivar();

            return response()->json([
                'message' => 'Patrocinador eliminado',
                'status' => true,
                'patrocinador' => $patrocinador,
            ], Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
