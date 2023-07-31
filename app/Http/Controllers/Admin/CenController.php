<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['cens'] = Cen::paginate(5);
        return view('cen.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cen.create');
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
    
        Cen::insert($datosComisione);
        return redirect('cen.index')->with('mensaje', 'Archivo agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cen $cen)
    {
        $datos['carrusels'] = Session::get('carrusel_data.carrusels', []);
    $datos['numImages'] = Session::get('carrusel_data.numImages', 3);

    $datos['comisiones'] = $cen;
    
    if ($cen->ajax()) {
        return response()->json($cen);
    } else {
        return view('cen.show', compact('comisiones') + $datos);
    }
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $comisione=Cen::findOrFail($id);
        return view('cen.edit', compact('comisione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        $comisione = Cen::findOrFail($id);
        Cen::where('id', '=', $id)->update($datosComisione);
        return redirect('cen.index')->with('mensaje', 'Archivo modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $comisione = Cen::findOrFail($id);

            Cen::destroy($id);
    
        return redirect('cen.index')->with('mensaje', 'Archivo borrado');
    }
}
