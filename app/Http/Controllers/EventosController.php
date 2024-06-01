<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class EventosController extends Controller
{
    // Listar eventos
    public function listarEventos()
    {
        try {
            $eventos = Eventos::where('estado', 1)->get();
            return response()->json($eventos);
        } catch (\Throwable $th) {
            return response()->json([
               'message' => $th->getMessage(),
               'status' => false
           ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
           'message' => 'okey',
           'status' => true,
           'eventos' => $eventos,
       ], Response::HTTP_OK);
    }
    //crear Eventos
    public function crearEventos(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
            'id_categoria' => 'required|integer',
            'id_deporte' => 'required|integer',
            'id_patrocinador' => 'required|integer',
            'id_municipio' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i:s',
            'equipos_participantes' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $path = $file->store('public/imagenes'); // Guarda la imagen en el directorio 'public/imagenes'
                $data['imagen'] = $path;
            }

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $eventos = Eventos::create([
            'id_categoria' => $request->id_categoria,
            'id_deporte' => $request->id_deporte,
            'id_patrocinador' => $request->id_patrocinador,
            'id_municipio' => $request->id_municipio,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_final' => $request->fecha_final,
            'hora' => $request->hora,
            'equipos_participantes' => $request->equipos_participantes,
            'ubicacion' => $request->ubicacion,
            'rama' => $request->rama,
            'imagen' => $data['imagen'] ?? null
        ]);
        } catch (\Throwable $th) {
            return response()->json([
            'message' => $th->getMessage(),
            'status' => false
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
        'message' => 'Evento creado correctamente',
        'status' => true,
        'evento' => $eventos,
    ], Response::HTTP_OK);
    }
    //Consultar Eventos
    public function consultarEvento($id)
    {
        try {
            $eventos = Eventos::find($id);
            if (!$eventos) {
                return response()->json(['message' => 'Evento no encontrado'], 404);
            }
            return response()->json($eventos, 200);
        } catch (\Throwable $th) {
            return response()->json([
            'message' => $th->getMessage(),
            'status' => false
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    // Editar Evento
    public function editarEvento(Request $request, $id)
    {
        try {
            $evento = Eventos::find($id);

            if (!$evento) {
                return response()->json([
                'message' => 'Evento no encontrado',
                'status' => false
            ], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
            'id_categoria' => 'required|integer',
            'id_deporte' => 'required|integer',
            'id_patrocinador' => 'required|integer',
            'id_municipio' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_final' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i:s',
            'equipos_participantes' => 'required|string|max:255'
        ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $evento->update($request->all());

            return response()->json([
            'message' => 'Evento actualizado correctamente',
            'status' => true,
            'evento' => $evento,
        ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
            'message' => $th->getMessage(),
            'status' => false
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function desactivarEvento($id)
    {
        try {
            $eventos = Eventos::find($id);
            if (!$eventos) {
                return response()->json(['message' => 'Evento no encontrado'], 404);
            }

            $eventos->desactivar();

            return response()->json([
                'message' => 'Evento eliminado',
                'status' => true,
                'eventos' => $eventos,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
