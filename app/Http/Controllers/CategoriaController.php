<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    //Listar categoria
    public function listarCategoria()
    {
        $categoria = Categoria::all();
        return response()->json($categoria);
    }
    //crear categoria
   public function crearCategoria(Request $request){
    
    try{
        $categoria = Categoria::make($request->all(), [
            'categoria' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $categoria = Categoria::create([
            'categoria' => $request->categoria
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
        'categoria' => $categoria,
    ], Response::HTTP_OK);
   }
   //Consultar Categoria
   public function consultarCategoria($id)
{
    $categoria = Categoria::find($id);
    if (!$categoria) {
        return response()->json(['message' => 'Categoria no encontrado'], 404);
    }
    return response()->json($categoria, 200);
}
//Editar categoria
    public function editarCategoria(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json(['message' => 'categoria no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'categoria' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $categoria->update($request->all());

        return response()->json([
            'message' => 'Categoria actualizado exitosamente',
            'status' => true,
            'arbitro' => $categoria,
        ], Response::HTTP_OK);
    }
}
