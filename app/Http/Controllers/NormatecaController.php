<?php

namespace App\Http\Controllers;

use App\Models\Normateca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class NormatecaController extends Controller
{
    public function index()
    {
        
           
            $datos['normatecas'] = Normateca::paginate(5);
            return view('normateca.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('normateca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $campos = [
        'Archivo' => 'required|max:50000|mimes:docx,pdf,xlsx,zip,rar,doc',
        'Nombre' => 'required|string|max:30',
        'Descripcion' => 'required|string|max:100'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
        'Archivo.required' => 'El archivo es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosNormateca = $request->except('_token');
    $datosNormateca['created_at'] = Carbon::now()->subHour();; 
    $datosNormateca['opcion'] = $request->input('opcion');

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/normatecas');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/normatecas');
        $datosNormateca['Archivo'] = $rutaArchivo;
    }

    Normateca::insert($datosNormateca);
    return redirect('normateca')->with('mensaje', 'Archivo agregado con éxito');
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

    $busqueda = $request->input('busqueda');
    $orden = $request->input('orden', 'asc');
    $tipo = $request->input('tipo', '');

    $normatecasQuery = Normateca::orderBy('Nombre', $orden);


    if ($busqueda) {
        $normatecasQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $normatecas = $normatecasQuery->get();

    $datos['normatecas'] = $normatecas;
    
    if ($request->ajax()) {
        return response()->json($normatecas);
    } else {
        return view('normateca.show', compact('normatecas', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $normateca=Normateca::findOrFail($id);
        return view('normateca.edit', compact('normateca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $campos = [
        'Archivo' => 'required|max:50000|mimes:docx,pdf,xlsx,zip,rar,doc',
        'Nombre' => 'required|string|max:30',
        'Descripcion' => 'required|string|max:100'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
        'Archivo.required' => 'El archivo es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    if ($request->hasFile('Archivo')) {
        $campos = ['Archivo' => 'required|max:50000|mimes:docx,pdf,xlsx,zip,rar,doc'];
        $mensaje = ['Archivo.required' => 'El archivo es requerido'];
    }

    $datosNormateca = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $normateca = Normateca::findOrFail($id);
        Storage::delete($normateca->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/normatecas');
        $rutaArchivo = $archivo->store('public/normatecas');
        $datosNormateca['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $normateca = Normateca::findOrFail($id);
    Normateca::where('id', '=', $id)->update($datosNormateca);
    return redirect('normateca')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $normateca = Normateca::findOrFail($id);

        if (Storage::delete($normateca->Archivo)) {
            Normateca::destroy($id);
        }

        return redirect('normateca')->with('mensaje', 'Archivo borrado');
    }
}
