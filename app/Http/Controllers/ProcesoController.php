<?php

namespace App\Http\Controllers;

use App\Models\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            // Obtener los carruseles de la sesión
            $carrusels = Session::get('carrusel_data.carrusels', []);
            $numImages = Session::get('carrusel_data.numImages', 3);
    
            
            $datos['procesos'] = Proceso::paginate(5);
    
            // Combinar los datos en un solo arreglo
            $datos['carrusels'] = $carrusels;
            $datos['numImages'] = $numImages;
    
            // Guardar los datos en la sesión antes de cerrarla
            Session::put('carrusel_data', $datos);
            Session::keep(['carrusel_data']);
    
            return view('proceso.index', $datos);
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('proceso.create');
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

    $datosProceso = $request->except('_token');
    $datosProceso['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/procesos');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/procesos');
        $datosProceso['Archivo'] = $rutaArchivo;
    }

    Proceso::insert($datosProceso);
    return redirect('proceso')->with('mensaje', 'Archivo agregado con éxito');
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

    $procesosQuery = Proceso::orderBy('Nombre', $orden);

    if ($tipo === 'mes') {
        $procesosQuery->where('created_at', '>=', Carbon::now()->subMonth());
    } elseif ($tipo === 'semana') {
        $procesosQuery->where('created_at', '>=', Carbon::now()->subWeek());
    } elseif ($tipo === 'dia') {
        $procesosQuery->where('created_at', '>=', Carbon::now()->subDay());
    }

    if ($busqueda) {
        $procesosQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $procesos = $procesosQuery->get();

    Session::put('carrusel_data', $datos);
    Session::save();

    $datos['procesos'] = $procesos;
    
    if ($request->ajax()) {
        return response()->json($procesos);
    } else {
        return view('proceso.show', compact('procesos', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proceso=Proceso::findOrFail($id);
        return view('proceso.edit', compact('proceso'));
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

    $datosProceso = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $proceso = Proceso::findOrFail($id);
        Storage::delete($proceso->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/procesos');
        $rutaArchivo = $archivo->store('public/procesos');
        $datosProceso['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $proceso = Proceso::findOrFail($id);
    Proceso::where('id', '=', $id)->update($datosProceso);
    return redirect('proceso')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $proceso = Proceso::findOrFail($id);

        if (Storage::delete($proceso->Archivo)) {
            Proceso::destroy($id);
        }

        return redirect('proceso')->with('mensaje', 'Archivo borrado');
    }
}