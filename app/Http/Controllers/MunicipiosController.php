<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class MunicipiosController extends Controller
{
    // Listar Municipios
    public function listarMunicipios()
    {
        try {
            $municipios = Municipios::all(); // Asumiendo que queremos listar todos los municipios
            return response()->json($municipios);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Crear Municipio
    public function crearMunicipio(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'municipio' => 'required|string|max:255',
                'departamento' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $municipio = Municipio::create($request->all());
            return response()->json([
                'message' => 'Municipio creado exitosamente',
                'status' => true,
                'municipio' => $municipio
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Consultar Municipio
    public function consultarMunicipio($id)
    {
        try {
            $municipio = Municipio::find($id);
            if (!$municipio) {
                return response()->json(['message' => 'Municipio no encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($municipio, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Editar Municipio
    public function editarMunicipio(Request $request, $id)
    {
        try {
            $municipio = Municipio::find($id);
            if (!$municipio) {
                return response()->json(['message' => 'Municipio no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'municipio' => 'required|string|max:255',
                'departamento' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $municipio->update($request->all());
            return response()->json([
                'message' => 'Municipio actualizado exitosamente',
                'status' => true,
                'municipio' => $municipio
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Desactivar Municipio
    public function desactivarMunicipio($id)
    {
        try {
            $municipio = Municipio::find($id);
            if (!$municipio) {
                return response()->json(['message' => 'Municipio no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $municipio->desactivar(); // Asumiendo que el método desactivar está definido en el Modelo Municipio
            return response()->json([
                'message' => 'Municipio desactivado exitosamente',
                'status' => true,
                'municipio' => $municipio
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
