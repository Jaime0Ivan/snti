<?php

namespace App\Http\Controllers;

use App\Models\Comisione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ComisioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
           
            $datos['comisiones'] = Comisione::paginate(5);
            return view('comisione.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('comisione.create');
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

    $datosComisione = $request->except('_token'); 

    Comisione::insert($datosComisione);
    return redirect('comisione')->with('mensaje', 'Archivo agregado con éxito');
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

    // Obtener los datos de la tabla Comisione y asignarlos a la variable $comisiones
    $comisiones = Comisione::all(); // O usa el método paginate para obtener solo algunos registros: Comisione::paginate(10);

    if ($request->ajax()) {
        return response()->json($comisiones);
    } else {
        return view('comisione.show', compact('comisiones') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comisione=Comisione::findOrFail($id);
        return view('comisione.edit', compact('comisione'));
    }
    
    /**a
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

    $datosComisione = $request->except(['_token', '_method']);


    // Obtener el valor original de created_at
    $comisione = Comisione::findOrFail($id);
    Comisione::where('id', '=', $id)->update($datosComisione);
    return redirect('comisione')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $comisione = Comisione::findOrFail($id);

            Comisione::destroy($id);
    
        return redirect('comisione')->with('mensaje', 'Archivo borrado');
    }
}
