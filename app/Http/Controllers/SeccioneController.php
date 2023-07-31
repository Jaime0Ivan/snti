<?php

namespace App\Http\Controllers;

use App\Models\Seccione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SeccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
           
            $datos['secciones'] = Seccione::paginate(5);
            return view('seccione.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('seccione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $campos = [
        'Archivo' => 'required|max:50000|mimes:docx,pdf,xlsx,zip,rar,doc',
        'Nombre' => 'required|string|max:30',
        'Descripcion' => 'required|string',
        'Titulo' => 'required|string|max:60',
        'Subtitulo' => 'required|string',
        'Texto' => 'required|string'
    ];

    $mensaje = [
        'required' => 'El :attribute es requerido',
        'Archivo.required' => 'El archivo es requerido',
    ];

    $this->validate($request, $campos, $mensaje);

    $datosSeccione = $request->except('_token');
    $datosSeccione['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/secciones');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/secciones');
        $datosSeccione['Archivo'] = $rutaArchivo;
    }

    Seccione::insert($datosSeccione);
    return redirect('seccione')->with('mensaje', 'Archivo agregado con éxito');
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
    $secciones = Seccione::all(); // O usa el método paginate para obtener solo algunos registros: Comisione::paginate(10);

    if ($request->ajax()) {
        return response()->json($secciones);
    } else {
        return view('seccione.show', compact('secciones') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $seccione=Seccione::findOrFail($id);
        return view('seccione.edit', compact('seccione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $campos = [
        'Archivo' => 'required|max:50000|mimes:docx,pdf,xlsx,zip,rar,doc',
        'Nombre' => 'required|string|max:30',
        'Descripcion' => 'required|string',
        'Titulo' => 'required|string|max:60',
        'Subtitulo' => 'required|string|max:150',
        'Texto' => 'required|string'
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

    $datosSeccione = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $seccione = Seccione::findOrFail($id);
        Storage::delete($seccione->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/secciones');
        $rutaArchivo = $archivo->store('public/secciones');
        $datosSeccione['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $seccione = Seccione::findOrFail($id);
    Seccione::where('id', '=', $id)->update($datosSeccione);
    return redirect('seccione')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $seccione = Seccione::findOrFail($id);

        if (Storage::delete($seccione->Archivo)) {
            Seccione::destroy($id);
        }

        return redirect('seccione')->with('mensaje', 'Archivo borrado');
    }
}

