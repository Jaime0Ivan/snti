<?php

namespace App\Http\Controllers;

use App\Models\Escalafon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class EscalafonController extends Controller
{
    public function index()
    {
        
            // Obtener los carruseles de la sesión
            $carrusels = Session::get('carrusel_data.carrusels', []);
            $numImages = Session::get('carrusel_data.numImages', 3);
    
         
            $datos['escalafons'] = Escalafon::paginate(5);
    
            // Combinar los datos en un solo arreglo
            $datos['carrusels'] = $carrusels;
            $datos['numImages'] = $numImages;
    
            // Guardar los datos en la sesión antes de cerrarla
            Session::put('carrusel_data', $datos);
            Session::keep(['carrusel_data']);
    
            return view('escalafon.index', $datos);
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('escalafon.create');
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

    $datosEscalafon = $request->except('_token');
    $datosEscalafon['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/escalafons');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/escalafons');
        $datosEscalafon['Archivo'] = $rutaArchivo;
    }

    Escalafon::insert($datosEscalafon);
    return redirect('escalafon')->with('mensaje', 'Archivo agregado con éxito');
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

    $escalafonsQuery = Escalafon::orderBy('Nombre', $orden);

    if ($tipo === 'mes') {
        $escalafonsQuery->where('created_at', '>=', Carbon::now()->subMonth());
    } elseif ($tipo === 'semana') {
        $escalafonsQuery->where('created_at', '>=', Carbon::now()->subWeek());
    } elseif ($tipo === 'dia') {
        $escalafonsQuery->where('created_at', '>=', Carbon::now()->subDay());
    }

    if ($busqueda) {
        $escalafonsQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $escalafons = $escalafonsQuery->get();

    Session::put('carrusel_data', $datos);
    Session::save();

    $datos['escalafons'] = $escalafons;
    
    if ($request->ajax()) {
        return response()->json($escalafons);
    } else {
        return view('escalafon.show', compact('escalafons', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $escalafon=Escalafon::findOrFail($id);
        return view('escalafon.edit', compact('escalafon'));
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

    $datosEscalafon = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $escalafon = Escalafon::findOrFail($id);
        Storage::delete($escalafon->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/escalafons');
        $rutaArchivo = $archivo->store('public/escalafons');
        $datosEscalafon['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $escalafon = Escalafon::findOrFail($id);
    Escalafon::where('id', '=', $id)->update($datosEscalafon);
    return redirect('escalafon')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $escalafon = Escalafon::findOrFail($id);

        if (Storage::delete($escalafon->Archivo)) {
            Escalafon::destroy($id);
        }

        return redirect('escalafon')->with('mensaje', 'Archivo borrado');
    }
}
