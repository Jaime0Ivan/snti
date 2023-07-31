<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mensaje;
use App\Models\Area;

class MensajeController extends Controller
{
    public function mostrarFormulario()
    {
        $areas = Area::all();
        return view('formulario-mensaje', compact('areas'));
    }

    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'contacto' => 'required',
            'area_id' => 'required',
            'mensaje' => 'required',
            
        ]);

        Mensaje::create($request->all());

        return redirect()->back()->with('success', 'Mensaje enviado correctamente');
    }
    public function destroy(Mensaje $mensaje)
    {
        $mensaje = Mensaje::findOrFail($mensaje);
        $mensaje->delete();

        return redirect()->back()->with('success', 'El mensaje ha sido eliminado correctamente.');
    }

}
