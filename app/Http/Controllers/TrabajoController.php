<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TrabajoController extends Controller
{
    public function index()
    {
        
            // Obtener los carruseles de la sesión
            $carrusels = Session::get('carrusel_data.carrusels', []);
            $numImages = Session::get('carrusel_data.numImages', 3);
    
            
            $datos['trabajos'] = Trabajo::paginate(5);
    
            // Combinar los datos en un solo arreglo
            $datos['carrusels'] = $carrusels;
            $datos['numImages'] = $numImages;
    
            // Guardar los datos en la sesión antes de cerrarla
            Session::put('carrusel_data', $datos);
            Session::keep(['carrusel_data']);
    
            return view('trabajo.index', $datos);
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('trabajo.create');
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

    $datosTrabajo = $request->except('_token');
    $datosTrabajo['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/trabajos');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/trabajos');
        $datosTrabajo['Archivo'] = $rutaArchivo;
    }

    Trabajo::insert($datosTrabajo);
    return redirect('trabajo')->with('mensaje', 'Archivo agregado con éxito');
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

    $trabajosQuery = Trabajo::orderBy('Nombre', $orden);

    if ($tipo === 'mes') {
        $trabajosQuery->where('created_at', '>=', Carbon::now()->subMonth());
    } elseif ($tipo === 'semana') {
        $trabajosQuery->where('created_at', '>=', Carbon::now()->subWeek());
    } elseif ($tipo === 'dia') {
        $trabajosQuery->where('created_at', '>=', Carbon::now()->subDay());
    }

    if ($busqueda) {
        $trabajosQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $trabajos = $trabajosQuery->get();

    Session::put('carrusel_data', $datos);
    Session::save();

    $datos['trabajos'] = $trabajos;
    
    if ($request->ajax()) {
        return response()->json($trabajos);
    } else {
        return view('trabajo.show', compact('trabajos', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $trabajo=Trabajo::findOrFail($id);
        return view('trabajo.edit', compact('trabajo'));
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

    $datostrabajo = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $trabajo = Trabajo::findOrFail($id);
        Storage::delete($trabajo->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/trabajos');
        $rutaArchivo = $archivo->store('public/trabajos');
        $datosTrabajo['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $trabajo = Trabajo::findOrFail($id);
    Trabajo::where('id', '=', $id)->update($datostrabajo);
    return redirect('trabajo')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $trabajo = Trabajo::findOrFail($id);

        if (Storage::delete($trabajo->Archivo)) {
            Trabajo::destroy($id);
        }

        return redirect('trabajo')->with('mensaje', 'Archivo borrado');
    }
}
