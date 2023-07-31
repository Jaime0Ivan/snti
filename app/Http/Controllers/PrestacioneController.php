<?php

namespace App\Http\Controllers;

use App\Models\Prestacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PrestacioneController extends Controller
{
    public function index()
    {
        
            // Obtener los carruseles de la sesión
            $carrusels = Session::get('carrusel_data.carrusels', []);
            $numImages = Session::get('carrusel_data.numImages', 3);
    
            
            $datos['prestaciones'] = Prestacione::paginate(5);
    
            // Combinar los datos en un solo arreglo
            $datos['carrusels'] = $carrusels;
            $datos['numImages'] = $numImages;
    
            // Guardar los datos en la sesión antes de cerrarla
            Session::put('carrusel_data', $datos);
            Session::keep(['carrusel_data']);
    
            return view('prestacione.index', $datos);
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('prestacione.create');
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

    $datosPrestacione = $request->except('_token');
    $datosPrestacione['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/prestaciones');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/prestaciones');
        $datosPrestacione['Archivo'] = $rutaArchivo;
    }

    Prestacione::insert($datosPrestacione);
    return redirect('prestacione')->with('mensaje', 'Archivo agregado con éxito');
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

    $prestacionesQuery = Prestacione::orderBy('Nombre', $orden);

    if ($tipo === 'mes') {
        $prestacionesQuery->where('created_at', '>=', Carbon::now()->subMonth());
    } elseif ($tipo === 'semana') {
        $prestacionesQuery->where('created_at', '>=', Carbon::now()->subWeek());
    } elseif ($tipo === 'dia') {
        $prestacionesQuery->where('created_at', '>=', Carbon::now()->subDay());
    }

    if ($busqueda) {
        $prestacionesQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $prestaciones = $prestacionesQuery->get();

    Session::put('carrusel_data', $datos);
    Session::save();

    $datos['prestaciones'] = $prestaciones;
    
    if ($request->ajax()) {
        return response()->json($prestaciones);
    } else {
        return view('prestacione.show', compact('prestaciones', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestacione=Prestacione::findOrFail($id);
        return view('prestacione.edit', compact('prestacione'));
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

    $datosPrestacione = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $prestacione = Prestacione::findOrFail($id);
        Storage::delete($prestacione->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/prestaciones');
        $rutaArchivo = $archivo->store('public/prestaciones');
        $datosPrestacione['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $prestacione = Prestacione::findOrFail($id);
    Prestacione::where('id', '=', $id)->update($datosPrestacione);
    return redirect('prestacione')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $prestacione = Prestacione::findOrFail($id);

        if (Storage::delete($prestacione->Archivo)) {
            Prestacione::destroy($id);
        }

        return redirect('prestacione')->with('mensaje', 'Archivo borrado');
    }
}
