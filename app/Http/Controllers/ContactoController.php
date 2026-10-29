<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function obtenercontactos(Request $request)
    {

        $contactos = Contacto::where('usuario_id','=',$request->usuario_id);

        return response()->json(['contactos' => $contactos, 'mensaje' => 'Contactos obtenidos correctamente'], 200);

    }

    public function obtener()
    {

        $contactos = Contacto::all();

        return response()->json(['contactos' => $contactos, 'mensaje' => 'Contactos obtenidos correctamente'], 200);

    }
    public function obtenerContactoPorId(Request $request)
    {
        $contacto = Contacto::findorfail($request->id);
        if (! $contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], 404);
        }

        return response()->json(['contacto' => $contacto], 200);
    }

    public function agregarContatos(Request $request)
    {

        $validacion = Contacto::where('telefono', $request->telefono)->first();
        $validacion2 = Contacto::where('email', $request->email)->first();
         if ($validacion || $validacion2) {
            return response()->json(['error' => 'El número de contacto ya existe'], 400);
        }
        $contacto = Contacto::create(['nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'foto' => $request->foto,
            'email' => $request->email,
            'telefono' => $request->telefono,
             'usuario_id'=>$request->usuario_id]);
       
        
        
        return response()->json(['mensaje' => 'Contacto agregado correctamente', 'contacto' => $contacto], 201);
    }

    public function eliminarContatos(Request $request,int $id)
    {
        $contacto = Contacto::find('user_id', $request->user()->id)->first();
        if (! $contacto) {
            return response()->json(['mensaje' => 'Contacto no encontrado'], 404);
        }
        $contacto=Contacto::where('');
        $contacto=Contacto::findorfail($request->id);
        $contacto->delete();

        return response()->json(['mensaje' => 'Contacto eliminado correctamente'], 200);
    }

    public function modificarContatos(Request $request)
    {
        $contato = Contacto::find($request->id);
        if (! $contato) {
            return response()->json(['contacto' => 'contacto no encontrado'], 404);
        }

        $contato->update($request->all());
        $contato->save();

        return response()->json(['mensaje' => 'Contacto actualizado correctamente', 'contacto' => $contato], 200);
    }
}
