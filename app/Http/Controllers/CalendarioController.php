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
                'id_arbitro' => 'required|integer',
                'id_equipo1' => 'required|string',
                'id_equipo2' => 'required|string',
                'id_deportes' => 'required|integer',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i:s',
                'direccion' => 'required|string',
                'resultadoA' => 'nullable|integer',
                'resultadoB' => 'nullable|integer',
                'Cancha' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }
    
            $calendario = Calendario::create([
                'estado' => true, // valor predeterminado en caso de que no se proporcione en la solicitud
                'id_arbitro' => $request->input('id_arbitro'),
                'id_equipo1' => $request->input('id_equipo1'),
                'id_equipo2' => $request->input('id_equipo2'),
                'id_deportes' => $request->input('id_deportes'),
                'fecha' => $request->input('fecha'),
                'hora' => $request->input('hora', '12:00:00'), // valor predeterminado en caso de que no se proporcione en la solicitud
                'direccion' => $request->input('direccion'),
                'resultadoA' => $request->input('resultadoA'),
                'resultadoB' => $request->input('resultadoB'),
                'Cancha' => $request->input('Cancha'),
            ]);
            
            return response()->json([
                'message' => 'Calendario creado correctamente.',
                'status' => true,
                'calendario' => $calendario,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error interno del servidor: ' . $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    
    //Consultar Arbitro
    public function consultarCalendario($id_deportes)
    {
        try {
            $calendario = Calendario::find($id_deportes);
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
