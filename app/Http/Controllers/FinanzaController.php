<?php

namespace App\Http\Controllers;

use App\Models\Finanza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class FinanzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
           
            $datos['finanzas'] = Finanza::paginate(5);
            return view('finanza.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('finanza.create');
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

    $datosFinanza = $request->except('_token');
    $datosFinanza['created_at'] = Carbon::now()->subHour();; 

    if ($request->hasFile('Archivo')) {
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/finanzas');

        if (!is_writable($carpetaDestino)) {
            chmod($carpetaDestino, 0755);
        }

        $rutaArchivo = $archivo->store('public/finanzas');
        $datosFinanza['Archivo'] = $rutaArchivo;
    }

    Finanza::insert($datosFinanza);
    return redirect('finanza')->with('mensaje', 'Archivo agregado con éxito');
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

    $finanzasQuery = Finanza::orderBy('Nombre', $orden);


    if ($busqueda) {
        $finanzasQuery->where(function ($query) use ($busqueda) {
            $query->where('Nombre', 'LIKE', "%$busqueda%")
                ->orWhere('Descripcion', 'LIKE', "%$busqueda%")
                ->orWhere('created_at', 'LIKE', "%$busqueda%");
        });
    }

    $finanzas = $finanzasQuery->get();

    $datos['finanzas'] = $finanzas;
    
    if ($request->ajax()) {
        return response()->json($finanzas);
    } else {
        return view('finanza.show', compact('finanzas', 'orden', 'tipo', 'busqueda') + $datos);
    }
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $finanza=Finanza::findOrFail($id);
        return view('finanza.edit', compact('finanza'));
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

    $datosFinanza = $request->except(['_token', '_method']);

    if ($request->hasFile('Archivo')) {
        $finanza = Finanza::findOrFail($id);
        Storage::delete($finanza->Archivo);
        $archivo = $request->file('Archivo');
        $carpetaDestino = storage_path('app/public/finanzas');
        $rutaArchivo = $archivo->store('public/finanzas');
        $datosFinanza['Archivo'] = $rutaArchivo;
    }

    // Obtener el valor original de created_at
    $finanza = Finanza::findOrFail($id);
    Finanza::where('id', '=', $id)->update($datosFinanza);
    return redirect('finanza')->with('mensaje', 'Archivo modificado');
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $finanza = Finanza::findOrFail($id);

        if (Storage::delete($finanza->Archivo)) {
            Finanza::destroy($id);
        }

        return redirect('finanza')->with('mensaje', 'Archivo borrado');
    }
}
