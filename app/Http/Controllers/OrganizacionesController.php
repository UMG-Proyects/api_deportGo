<?php

namespace App\Http\Controllers;

use App\Models\Organizaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class OrganizacionesController extends Controller
{
    // Listar Organizaciones
    public function listarOrganizaciones()
    {
        try {
            $organizaciones = Organizaciones::where('estado', true)->get();
            return response()->json($organizaciones);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Crear Organización
    public function crearOrganizacion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|numeric',
                'correo_electronico' => 'required|email|max:255',
                'no_de_cuenta' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $organizacion = Organizacion::create($request->all());
            return response()->json([
                'message' => 'Organización creada exitosamente',
                'status' => true,
                'organizacion' => $organizacion
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Consultar Organización
    public function consultarOrganizacion($id)
    {
        try {
            $organizacion = Organizacion::find($id);
            if (!$organizacion) {
                return response()->json(['message' => 'Organización no encontrada'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($organizacion, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Editar Organización
    public function editarOrganizacion(Request $request, $id)
    {
        try {
            $organizacion = Organizacion::find($id);
            if (!$organizacion) {
                return response()->json(['message' => 'Organización no encontrada'], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'telefono' => 'required|numeric',
                'correo_electronico' => 'required|email|max:255',
                'no_de_cuenta' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $organizacion->update($request->all());
            return response()->json([
                'message' => 'Organización actualizada exitosamente',
                'status' => true,
                'organizacion' => $organizacion
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Desactivar Organización
    public function desactivarOrganizacion($id)
    {
        try {
            $organizacion = Organizacion::find($id);
            if (!$organizacion) {
                return response()->json(['message' => 'Organización no encontrada'], Response::HTTP_NOT_FOUND);
            }

            $organizacion->desactivar();
            return response()->json([
                'message' => 'Organización desactivada',
                'status' => true,
                'organizacion' => $organizacion
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
