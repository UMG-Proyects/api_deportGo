<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deporte;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SportsController extends Controller
{
    public function crearDeporte(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'status' => false,
                ], Response::HTTP_BAD_REQUEST);
            }

            $deportes = Deporte::create([
                'nombre' => $request->nombre,
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
            'deportes' => $deportes,
        ], Response::HTTP_OK);
    }

    public function listarDeportes()
    {
        try {
            $deportes = Deporte::where('estado', 1)->get();

            return response()->json($deportes);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function consultarDeportes($id)
    {
        try {
            $deportes = Deporte::find($id);
            if (!$deportes) {
                return response()->json(['message' => 'Deporte no encontrado'], 404);
            }
            return response()->json($deportes, Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editarDeportes(Request $request, $id)
    {
        try {
            $deportes = Deporte::find($id);
            if (!$deportes) {
                return response()->json(['message' => 'Deporte no encontrado'], 404);
            }

            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $deportes->update($request->all());

            return response()->json([
                'message' => 'Deporte actualizado exitosamente',
                'status' => true,
                'arbitro' => $deportes,
            ], Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function desactivarDeporte($id)
    {
        try {
            $deportes = Deporte::find($id);
            if (!$deportes) {
                return response()->json(['message' => 'Deporte no encontrado'], 404);
            }

            $deportes->desactivar();

            return response()->json([
                'message' => 'Deporte eliminado',
                'status' => true,
                'deportes' => $deportes,
            ], Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
