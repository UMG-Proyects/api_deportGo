<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class CalendarioController extends Controller
{
    // Listar Calendario
    public function listarCalendario()
    {
        try {
            $calendario = Calendario::where('estado', 1)->get();
            return response()->json($calendario);
        } catch (\Throwable $th) {
            return response()->json([
               'message' => $th->getMessage(),
               'status' => false
           ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
           'message' => 'okey',
           'status' => true,
           'calendario' => $calendario,
       ], Response::HTTP_OK);
    }
    //crear Calendario
    public function crearCalendario(Request $request)
    {
        
        try {
            $validator = Validator::make($request->all(), [
                'id_deportes' => 'nullable|integer',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i:s',
        ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $calendario = Calendario::create([
                'estado' => $request->input('estado', true),
                'id_arbitro' => $request->input('id_arbitro'),
                'id_equipo' => $request->input('id_equipo'),
                'id_deportes' => $request->input('id_deportes'),
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hora', '12:00:00'),
                'direccion' => $request->input('direccion'),
                'resultadoA' => $request->input('resultadoA'),
                'resultadoB' => $request->input('resultadoB'),
                'Cancha' => $request->input('Cancha'),
        ]);
        } catch (\Throwable $th) {
            return response()->json([
            'message'=>$th->getMessage(),
            'status'=>false
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
        'message'=> 'okey',
        'status'=>true,
        'calendario' => $calendario,
    ], Response::HTTP_OK);
    }
    //Consultar Arbitro
    public function consultarCalendario($id)
    {
        try {
            $calendario = Calendario::find($id);
            if (!$calendario) {
                return response()->json(['message' => 'Calendario no encontrado'], 404);
            }
            return response()->json($calendario, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //Editar Arbitro
    public function editarCalendario(Request $request, $id)
    {
        try {
            $calendario = Calendario::find($id);
            if (!$calendario) {
                return response()->json(['message' => 'Calendario no encontrado'], 404);
            }

            $validator = Validator::make($request->all(), [
                'id_deportes' => 'nullable|integer',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i:s'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $calendario->update($request->all());

            return response()->json([
                'message' => 'Calendario actualizado exitosamente',
                'status' => true,
                'calendario' => $calendario,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>$th->getMessage(),
                'status'=>false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message'=> 'okey',
            'status'=>true,
            'calendario' => $calendario,
        ], Response::HTTP_OK);
    }
    public function desactivarCalendario($id)
    {
        try {
            $calendario = Calendario::find($id);
            if (!$calendario) {
                return response()->json(['message' => 'Calendario no encontrado'], 404);
            }

            $calendario->desactivar();

            return response()->json([
                'message' => 'Arbitro eliminado',
                'status' => true,
                'patrocinador' => $calendario,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
