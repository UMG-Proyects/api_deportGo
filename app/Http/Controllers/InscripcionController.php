<?php
namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Models\Eventos;

class InscripcionController extends Controller
{
    // Listar inscripciones
    public function listarInscripciones()
    {
        $inscripciones = Inscripcion::all();
        return response()->json($inscripciones);
    }

    // Crear inscripción
    public function crearInscripcion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre'=> 'requerid|string',
                'tarifa' => 'integer',
                'fecha' => 'required|date',
                'id_evento' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // Buscar el evento por id
            $evento = Eventos::find($request->id_evento);

            if (!$evento) {
                return response()->json(['message' => 'El evento con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }

            // Verificar si la fecha de inscripción es posterior a la fecha de inicio del evento
            $fechaInscripcion = Carbon::parse($request->fecha);
            $fechaInicioEvento = Carbon::parse($evento->fecha_inicio);

            if ($fechaInscripcion->gt($fechaInicioEvento)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Evento no disponible'
                ], Response::HTTP_BAD_REQUEST);
            }

            // Verificar si el número de inscripciones no excede el número total de participantes permitidos
            $inscripcionesExistentes = Inscripcion::where('id_evento', $request->id_evento)->count();
            if ($inscripcionesExistentes >= $evento->participantes) {
                return response()->json([
                    'status' => false,
                    'message' => 'El evento ha alcanzado el número máximo de participantes permitidos'
                ], 429);
            }

            // Crear la inscripción
            $inscripcion = Inscripcion::create([
                'id_equipo' => $request->id_equipo,
                'id_evento' => $evento->id,
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'genero' => $request->genero,
                'telefono' => $request->telefono,
                'telefono_emergencia' => $request->telefono_emergencia,
                'nombre_entrenador' => $request->nombre_entrenador,
                'tarifa' => $request->tarifa,
                'fecha' => $request->fecha,
            ]);

            return response()->json([
                'message' => 'Inscripción creada exitosamente',
                'status' => true,
                'inscripcion' => $inscripcion,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Consultar inscripción
    public function consultarInscripcion($id)
    {
        try {
            $inscripcion = Inscripcion::find($id);
            if (!$inscripcion) {
                return response()->json(['message' => 'Inscripción no encontrada'], 404);
            }
            return response()->json($inscripcion, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Editar inscripción
    public function editarInscripcion(Request $request, $id)
    {
        try {
            $inscripcion = Inscripcion::find($id);

            if (!$inscripcion) {
                return response()->json([
                    'message' => 'Inscripción no encontrada',
                    'status' => false
                ], Response::HTTP_NOT_FOUND);
            }

            $validator = Validator::make($request->all(), [
                'nombre'=> 'requerid|string',
                'tarifa' => 'integer',
                'fecha' => 'required|date',
                'id_evento' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $inscripcion->update($request->all());

            return response()->json([
                'message' => 'Inscripción actualizada correctamente',
                'status' => true,
                'inscripcion' => $inscripcion,
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Desactivar inscripción
    public function desactivarInscripcion($id)
    {
        try {
            $inscripcion = Inscripcion::find($id);
            if (!$inscripcion) {
                return response()->json(['message' => 'Inscripción no encontrada'], 404);
            }

            $inscripcion->desactivar();

            return response()->json([
                'message' => 'Inscripción desactivada',
                'status' => true,
                'inscripcion' => $inscripcion,
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
