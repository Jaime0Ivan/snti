<?php

namespace App\Http\Controllers;

use App\Models\Acerca;
use App\Models\Ubicacion;
use App\Models\Contactano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AcercaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
           
            $datos['acercas'] = Acerca::paginate(5);
            return view('acerca.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('acerca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $campos = [
        'Titulo' => 'required|string|max:30',
        'Texto' => 'required'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosAcerca = $request->except('_token');
    
    Acerca::insert($datosAcerca);
    return redirect('acerca')->with('mensaje', 'Archivo agregado con éxito');
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
        return view('acerca.show', compact('ubicacions', 'acercas', 'contactanos') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $acerca=Acerca::findOrFail($id);
        return view('acerca.edit', compact('acerca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $campos = [
        'Titulo' => 'required|string|max:30',
        'Texto' => 'required'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
      
    ];

    $this->validate($request, $campos, $mensaje);

    $datosAcerca = $request->except(['_token', '_method']);

    // Obtener el valor original de created_at
    $acerca = Acerca::findOrFail($id);
    Acerca::where('id', '=', $id)->update($datosAcerca);
    return redirect('acerca')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $acerca = Acerca::findOrFail($id);

            Acerca::destroy($id);

        return redirect('acerca')->with('mensaje', 'Archivo borrado');
    }
}
