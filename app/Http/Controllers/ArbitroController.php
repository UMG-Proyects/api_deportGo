<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ArbitroController extends Controller
{
    //Listar Arbitro
    public function listarArbitro()
    {
        try{
            $arbitro = Arbitro::where('estado', 1)->get();
        return response()->json($arbitro);
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
            'arbitro' => $arbitro,
        ], Response::HTTP_OK);
        
    }
    //crear Arbitro
   public function crearArbitro(Request $request){
    
    try{
        $validator = Validator::make($request->all(), [
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|numeric|min:8'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $arbitro = Arbitro::create([
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido'=> $request->primer_apellido,
            'segundo_apellido'=> $request->segundo_apellido,
            'genero'=> $request->genero,
            'direccion'=> $request->direccion,
            'telefono' => $request->telefono,
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
        'arbitro' => $arbitro,
    ], Response::HTTP_OK);
   }

   //Consultar Arbitro
   public function consultarArbitro($id)
    {
        try {
            $arbitro = Arbitro::find($id);
            if (!$arbitro) {
                return response()->json(['message' => 'Arbitro no encontrado'], 404);
            }
            return response()->json($arbitro, 200);
        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //Editar Arbitro
    public function editarArbitro(Request $request, $id)
    {
        try{
            $arbitro = Arbitro::find($id);
            if (!$arbitro) {
                return response()->json(['message' => 'Arbitro no encontrado'], 404);
            }
    
            $validator = Validator::make($request->all(), [
                'primer_nombre' => 'required|string|max:255',
                'primer_apellido' => 'required|string|max:255',
                'direccion' => 'required|string|max:255',
                'telefono' => 'required|numeric|min:8'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            }
    
            $arbitro->update($request->all());
    
            return response()->json([
                'message' => 'Arbitro actualizado exitosamente',
                'status' => true,
                'arbitro' => $arbitro,
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
            'arbitro' => $arbitro,
        ], Response::HTTP_OK);
        
    }
    
    public function desactivarArbitro($id)
    {
        try {
            $arbitro = Arbitro::find($id);
            if (!$arbitro) {
                return response()->json(['message' => 'Arbitro no encontrado'], 404);
            }

            $arbitro->desactivar();

            return response()->json([
                'message' => 'Arbitro eliminado',
                'status' => true,
                'patrocinador' => $arbitro,
            ], Response::HTTP_OK);

        } catch(\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}