<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Models\Acerca;
use App\Models\Contactano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
           
            $datos['ubicacions'] = Ubicacion::paginate(5);
            return view('ubicacion.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ubicacion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $campos = [
        'Titulo' => 'required|string|max:60',
        'Texto' => 'required|string'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosUbicacion = $request->except('_token');

    Ubicacion::insert($datosUbicacion);
    return redirect('ubicacion')->with('mensaje', 'Archivo agregado con éxito');
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

    $ubicacions = Ubicacion::all();
    $acercas = Acerca::all();
    $contactanos = Contactano::all();
    
    if ($request->ajax()) {
        return response()->json($ubicacions);
    } else {
        return view('ubicacion.show', compact('ubicacions', 'acercas', 'contactanos') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ubicacion=Ubicacion::findOrFail($id);
        return view('ubicacion.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $campos = [
        'Titulo' => 'required|string|max:60',
        'Texto' => 'required|string'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosUbicacion = $request->except(['_token', '_method']);

    // Obtener el valor original de created_at
    $ubicacion = Ubicacion::findOrFail($id);
    Ubicacion::where('id', '=', $id)->update($datosUbicacion);
    return redirect('ubicacion')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $ubicacion = Ubicacion::findOrFail($id);
 
            Ubicacion::destroy($id);

        return redirect('ubicacion')->with('mensaje', 'Archivo borrado');
    }
}
