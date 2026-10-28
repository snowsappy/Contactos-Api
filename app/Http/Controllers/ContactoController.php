<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function obtenercontactos()
    {

        $contactos = Contacto::all();

        return response()->json(['contactos' => $contactos, 'mensaje' => 'Contactos obtenidos correctamente'], 200);

    }

    public function obtenerContactoPorId(Request $request)
    {
        $contacto = Contacto::find($request->id);
        if (! $contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], 404);
        }

        return response()->json(['contacto' => $contacto], 200);
    }

    public function agregarContatos(Request $request)
    {
        $contacto = Contacto::create(['nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'foto' => $request->foto,
            'email' => $request->email,
            'telefono' => $request->telefono]);
        $validacion = Contacto::where('numero', $request->numero)->first();
        if ($validacion) {
            return response()->json(['error' => 'El número de contacto ya existe'], 400);
        }

        return response()->json(['mensaje' => 'Contacto agregado correctamente', 'contacto' => $contacto], 201);
    }

    public function eliminarContatos(Request $request)
    {
        $contacto = Contacto::find($request->id);
        if (! $contacto) {
            return response()->json(['mensaje' => 'Contacto no encontrado'], 404);
        }
        $contacto->destroy($request->id);

        return response()->json(['mensaje' => 'Contacto eliminado correctamente'], 200);
    }

    public function modificarContato(Request $request)
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
