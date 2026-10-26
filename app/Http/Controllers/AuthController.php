<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request){

        $usuario=Usuario::where('email','=','$request->email');

        /*if(!$usuario){

            return response()->json(['email'=>'usuario no encontrado']);

        }*/
        
        if(!$usuario || Hash::check($request->validated('password'),$usuario->password)){

            return response()->json(['message'=>'correo o contraseña invalido']);

        }
        //estudiar esto que todavia no me lo se bien
        $token=Usuario::createToken($request->validated('device_name'))->plainTextToken;
        
        return response()->json(['message'=>'datos de incio correctos','TokenType'=>'Bearer','usuario_resource'=>new UsuarioResource($usuario)]);
        


    }
}
