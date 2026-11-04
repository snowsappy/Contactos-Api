<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use DomainException;
use Exception;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function obtenercontactos(Request $request)
    {

        $contactos = Contacto::where('usuario_id', '=', $request->user()->id)->get();
        if (! $contactos) {

            return response()->json('no tiene contatos');
        }

        return response()->json(['contactos' => $contactos, 'mensaje' => 'Contactos obtenidos correctamente'], 200);

    }

    public function obtener()
    {

        $contactos = Contacto::all();

        return response()->json(['contactos' => $contactos, 'mensaje' => 'Contactos obtenidos correctamente'], 200);

    }

    public function obtenerContactoPorId(Request $request)
    {
        $contacto = Contacto::where('usuario_id', '=', $request->user()->id)->findOrfail($request->id);
        try{

        }catch(Exception $e){
            return response()->json(['error' => 'Contacto no encontrado'], $contacto);
        }
       
        return response()->json(['contacto' => $contacto], 200);
    }

    public function agregarContatos(Request $request)
    {
        if($request->apellido==null || $request->nombre==null ||  $request->telefono==null ||  $request->email==null){

            return response()->json(['error' => 'faltan campos por rellenar'], 400);        
        }
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
            'usuario_id' => $request->user()->id]);

        return response()->json(['mensaje' => 'Contacto agregado correctamente', 'contacto' => $contacto], 201);
    }

    public function eliminarContatos(Request $request)
    {   

    try{
        $contacto = Contacto::where('usuario_id', $request->user()->id)
                    ->findOrFail($request->id);
    }catch(Exception $e){

        return response()->json(['mensaje' => 'Contacto no encontrado'], 404);

    }
       
        
        $contacto->delete();

        return response()->json(['mensaje' => 'Contacto eliminado correctamente'], 200);
    }

    public function modificarContatos(Request $request)
    {  
        try{
        $contato = Contacto::where('usuario_id', '=', $request->user()->id)->findOrfail($request->id);
        }catch(Exception $e){
            return response()->json(['contacto' => 'contacto no encontrado'], 404);
        }
       

        $contato->update($request->all());
        $contato->save();

        return response()->json(['mensaje' => 'Contacto actualizado correctamente', 'contacto' => $contato], 200);
    }
}
