<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ArbitroController extends Controller
{
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
}
