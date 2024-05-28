<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class EquipoController extends Controller
{
    //Listar Equipo
    public function listarEquipo()
    {
        try{
            $equipo = Equipo::where('estado', 1)->get();
        return response()->json($equipo);
        }
        catch(\Throwable $th){
            return response()->json([
                'message'=>$th->getMessage(),
                'status'=>false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        return response()->json([
            'message'=> 'okey',
            'status'=>true,
            'equipo' => $equipo,
        ], Response::HTTP_OK);
        
    }
    //crear Arbitro
   public function crearEquipo(Request $request){
    
    try{
        $validator = Validator::make($request->all(),[
            'estado' => 'required|boolean',
            'id_deporte' => 'required|integer',
            'id_categoria' => 'required|integer',
            'id_municipio' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'participantes' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $equipo = Equipo::create([
            'estado' => $request->estado,
            'id_deporte' => $request->id_deporte,
            'id_categoria' => $request->id_categoria,
            'id_municipio' => $request->id_municipio,
            'nombre' => $request->nombre,
            'participantes' => $request->participantes,
        ]);
    }
    catch(\Throwable $th){
        return response()->json([
            'message'=>$th->getMessage(),
            'status'=>false
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
        'message'=> 'okey',
        'status'=>true,
        'equipo' => $equipo,
    ], Response::HTTP_OK);
   }
   //Consultar Arbitro
   public function consultarEquipo($id)
    {
        try {
            $equipo = Equipo::find($id);
            if (!$equipo) {
                return response()->json(['message' => 'Equipo no encontrado'], 404);
            }
            return response()->json($equipo, 200);
        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //Editar Arbitro
    public function editarEquipo(Request $request, $id)
    {
        try{
            $equipo = Equipo::find($id);
            if (!$equipo) {
                return response()->json(['message' => 'Equipo no encontrado'], 404);
            }
    
            $validator = Validator::make($request->all(),[
                'estado' => 'required|boolean',
                'id_deporte' => 'required|integer',
                'id_categoria' => 'required|integer',
                'id_municipio' => 'required|integer',
                'nombre' => 'required|string|max:255',
                'participantes' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }
    
            $equipo->update($request->all());
    
            return response()->json([
                'message' => 'Equipo actualizado exitosamente',
                'status' => true,
                'equipo' => $equipo,
            ], Response::HTTP_OK);
        }
        catch(\Throwable $th){
            return response()->json([
                'message'=>$th->getMessage(),
                'status'=>false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    
        return response()->json([
            'message'=> 'okey',
            'status'=>true,
            'equipo' => $equipo,
        ], Response::HTTP_OK);
        
    }
    public function desactivarEquipo($id)
    {
        try {
            $equipo = Equipo::find($id);
            if (!$equipo) {
                return response()->json(['message' => 'Equipo no encontrado'], 404);
            }

            $equipo->desactivar();

            return response()->json([
                'message' => 'Equipo eliminado',
                'status' => true,
                'equipo' => $equipo,
            ], Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
