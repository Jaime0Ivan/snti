<?php

namespace App\Http\Controllers;

use App\Models\Pie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pies = Pie::paginate(5);
        return view('pie.index', compact('pies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'LogoP' => 'required|max:50000|mimes:jpeg,png,jpg',
            'TituloT' => 'required|string|max:20',
            'Texto' => 'required|string|max:20',          
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'LogoP.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        $datosPie = $request->except('_token');

        if ($request->hasFile('LogoP')) {
            $LogoP = $request->file('LogoP');
            $carpetaDestino = storage_path('app/public/pies');

            // Verificar permisos de la carpeta
            if (!is_writable($carpetaDestino)) {
                // Otorgar permisos de escritura si no los tiene
                chmod($carpetaDestino, 0755);
            }

            // Guardar la foto en la carpeta
            $rutaLogoP = $LogoP->store('public/pies');
            $datosPie['LogoP'] = $rutaLogoP;
        }

        Pie::insert($datosPie);
        return redirect('pie')->with('mensaje', 'Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pie $pie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pie = Pie::findOrFail($id);
        return view('pie.edit', compact('pie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'TituloT' => 'required|string|max:100',
            'Texto' => 'required|string|max:100',
        ];
        
        $mensaje = [
            'required' => 'El :attribute es requerido' 
        ];

        $this->validate($request, $campos, $mensaje);

        if ($request->hasFile('LogoP')) {
            $campos = ['LogoP' => 'required|max:50000|mimes:jpeg,png,jpg'];
            $mensaje = ['LogoP.required' => 'El logo es requerido'];
        }

        $datosPie = $request->except(['_token', '_method']);

        if ($request->hasFile('LogoP')) {
            $pie = Pie::findOrFail($id);
            Storage::delete($pie->LogoP);
            $LogoP = $request->file('LogoP');
            $carpetaDestino = storage_path('app/public/pies');
            $rutaLogoP = $LogoP->store('public/pies');
            $datosPie['LogoP'] = $rutaLogoP;
        }

        Pie::where('id', '=', $id)->update($datosPie);
        $pie = Pie::findOrFail($id);
        return redirect('pie')->with('mensaje', 'Empleado modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pie = Pie::findOrFail($id);

        if (Storage::delete($pie->LogoP)) {
            Pie::destroy($id);
        }

        return redirect('pie')->with('mensaje', 'Empleado borrado');
    }
}
