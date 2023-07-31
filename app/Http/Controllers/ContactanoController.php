<?php

namespace App\Http\Controllers;

use App\Models\Contactano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ContactanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
           
            $datos['contactanos'] = Contactano::paginate(5);
            return view('contactano.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('contactano.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $campos = [
        'Titulo' => 'required|string|max:30',
        'Texto' => 'required|string'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosContactano = $request->except('_token');

    Contactano::insert($datosContactano);
    return redirect('contactano')->with('mensaje', 'Archivo agregado con éxito');
}


    /**
     * Display the specified resource.
     */
    /**
 * Display the specified resource.
 */
public function show(Request $request)
{
    $datos['carrusels'] = Session::get('carrusel_data.carrusels', []);
    $datos['numImages'] = Session::get('carrusel_data.numImages', 3);

    $contactanos = Contactano::all();
    
    if ($request->ajax()) {
        return response()->json($contactanos);
    } else {
        return view('contactano.show', compact('contactanos') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contactano=Contactano::findOrFail($id);
        return view('contactano.edit', compact('contactano'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $campos = [
        'Titulo' => 'required|string|max:30',
        'Texto' => 'required|string'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosContactano = $request->except(['_token', '_method']);

    // Obtener el valor original de created_at
    $contactano = Contactano::findOrFail($id);
    Contactano::where('id', '=', $id)->update($datosContactano);
    return redirect('contactano')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $contactano = Contactano::findOrFail($id);

            Contactano::destroy($id);

        return redirect('contactano')->with('mensaje', 'Archivo borrado');
    }
}
