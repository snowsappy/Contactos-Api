<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(UsuarioRequest $request)
    {

        $usuario = Usuario::where('email', '=', '$request->email');

        /*if(!$usuario){

            return response()->json(['email'=>'usuario inexistente']);

        }*/

        if (! $usuario || Hash::check($request->validated('password'), $usuario->password)) {

            return response()->json(['message' => 'correo o contraseña invalido']);

        }
        // estudiar esto que todavia no me lo se bien
        $token = Usuario::createToken($request->validated('device'))->plainTextToken;

        return response()->json(['message' => 'datos de incio correctos', 'TokenType' => 'Bearer', 'usuario_resource' => new UsuarioResource($usuario), 'token' => $token]);

    }

   /* public function me(UsuarioRequest $request)
    {

        return response()->json(['usuario_resource' => new UsuarioResource($request->usuario)]);
    }
    */
     public function me(Request $request)
    {

        return new UsuarioResource($request->user());
    }
    public function logout(Request $request)
    {

        // aprenderse esto
        $request->user()->currentAccessToken()->delete();

        return response()->json()->nocontent();
    }
}
