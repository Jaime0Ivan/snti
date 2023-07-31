<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        
            // Obtener los carruseles de la sesión
            $carrusels = Session::get('carrusel_data.carrusels', []);
            $numImages = Session::get('carrusel_data.numImages', 3);
    
         
            $datos['convocatorias'] = Convocatoria::paginate(5);
    
            // Combinar los datos en un solo arreglo
            $datos['carrusels'] = $carrusels;
            $datos['numImages'] = $numImages;
    
            // Guardar los datos en la sesión antes de cerrarla
            Session::put('carrusel_data', $datos);
            Session::keep(['carrusel_data']);
    
            return view('convocatoria.index', $datos);
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('convocatoria.create');
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

    $datosConvocatoria = $request->except('_token');
    $datosConvocatoria['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/convocatorias');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/convocatorias');
        $datosConvocatoria['Archivo'] = $rutaArchivo;
    }

    Convocatoria::insert($datosConvocatoria);
    return redirect('convocatoria')->with('mensaje', 'Archivo agregado con éxito');
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

    $convocatoriasQuery = Convocatoria::orderBy('Nombre', $orden);

    if ($tipo === 'mes') {
        $convocatoriasQuery->where('created_at', '>=', Carbon::now()->subMonth());
    } elseif ($tipo === 'semana') {
        $convocatoriasQuery->where('created_at', '>=', Carbon::now()->subWeek());
    } elseif ($tipo === 'dia') {
        $convocatoriasQuery->where('created_at', '>=', Carbon::now()->subDay());
    }

    if ($busqueda) {
        $convocatoriasQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $convocatorias = $convocatoriasQuery->get();

    Session::put('carrusel_data', $datos);
    Session::save();

    $datos['convocatorias'] = $convocatorias;
    
    if ($request->ajax()) {
        return response()->json($convocatorias);
    } else {
        return view('convocatoria.show', compact('convocatorias', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $convocatoria=Convocatoria::findOrFail($id);
        return view('convocatoria.edit', compact('convocatoria'));
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

    $datosConvocatoria = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $convocatoria = Convocatoria::findOrFail($id);
        Storage::delete($convocatoria->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/convocatorias');
        $rutaArchivo = $archivo->store('public/convocatorias');
        $datosConvocatoria['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $convocatoria = Convocatoria::findOrFail($id);
    Convocatoria::where('id', '=', $id)->update($datosConvocatoria);
    return redirect('convocatoria')->with('mensaje', 'Archivo modificado');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $convocatoria = Convocatoria::findOrFail($id);

        if (Storage::delete($convocatoria->Archivo)) {
            Convocatoria::destroy($id);
        }

        return redirect('convocatoria')->with('mensaje', 'Archivo borrado');
    }
}
