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
                'id_equipo' => 'required|integer',
                'nombre' => 'required|string|max:255',
                'edad' => 'integer',
                'genero' => 'string|max:255',
                'participantes' => 'integer',
                'telefono' => 'required|integer',
                'telefono_emergencia' => 'integer',
                'nombre_entrenador' => 'required|string|max:255',
                'tarifa' => 'integer',
                'fecha' => 'required|date',
                'id_evento' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $evento = Eventos::find($request->id_evento);

            if (!$evento) {
                return response()->json(['message' => 'El evento con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }

            $fechaInscripcion = Carbon::parse($request->fecha);
            $fechaInicioEvento = Carbon::parse($evento->fecha_inicio);

            // Verificar si la fecha de inscripción es posterior a la fecha de inicio del evento
            if ($fechaInscripcion->gt($fechaInicioEvento)) {
                // Construir el mensaje con la fecha de finalización del evento
                $fechaFinalizacionEvento = Carbon::parse($evento->fecha_final)->toDateString();
                $mensaje = 'El evento ya ha comenzado y termina: ' . $fechaFinalizacionEvento;
                return response()->json(['message' => $mensaje], Response::HTTP_BAD_REQUEST);
            }

            // Crear la inscripción
            $inscripcion = Inscripcion::create([
                'id_equipo' => $request->id_equipo,
                'id_evento' => $evento->id,
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'genero' => $request->genero,
                'participantes' => $request->participantes,
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

    // Editar inscripciones
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
                'id_equipo' => 'required|integer',
                'nombre' => 'required|string|max:255',
                'edad' => 'integer',
                'genero' => 'string|max:255',
                'participantes' => 'integer',
                'telefono' => 'required|integer',
                'telefono_emergencia' => 'integer',
                'nombre_entrenador' => 'required|string|max:255',
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
}
