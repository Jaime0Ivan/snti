<?php

namespace App\Http\Controllers;

use App\Models\Carrusel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class CarruselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function index()
{
    $carrusels = Carrusel::paginate(5);
    $numImages = $carrusels->count();

    $carruselData = [
        'carrusels' => $carrusels,
        'numImages' => $numImages
    ];

    Session::put('carrusel_data', $carruselData);

    return view('carrusel.index', $carruselData);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carrusel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos=[
            'Imagen'=>'required|max:100000|mimes:jpeg,png,jpg'
        ];

        $mensaje=[
            'Imagen.required'=>'La foto es requerida'
        ];

        $this->validate($request,$campos,$mensaje);

        $datosCarrusel = $request->except('_token');
        
        if ($request->hasFile('Imagen')) {
            $imagen = $request->file('Imagen');
            $carpetaDestino = storage_path('app/public/uploads');

            // Verificar permisos de la carpeta
            if (!is_writable($carpetaDestino)) {
                // Otorgar permisos de escritura si no los tiene
                chmod($carpetaDestino, 0755);
            }

            $rutaImagen = $imagen->store('public/uploads');
            $datosCarrusel['Imagen'] = $rutaImagen;
        }
        
        Carrusel::insert($datosCarrusel);
        return  redirect('carrusel')->with('mensaje','Imagen agregada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function redirectToFinanza(Request $request)
    {
        $carrusels = Carrusel::paginate(5);
        $numImages = $carrusels->count();

        return redirect()->action([FinanzaController::class, 'show'])
            ->with('carrusels', $carrusels)
            ->with('numImages', $numImages);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $carrusel=Carrusel::findOrFail($id);
        return view('carrusel.edit', compact('carrusel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos=[];
        $mensaje=[];

        if ($request->hasFile('Imagen')) {
            $campos['Imagen'] = 'required|max:100000|mimes:jpeg,png,jpg';
            $mensaje['Imagen.required'] = 'La imagen es requerida';
        }

        $this->validate($request,$campos,$mensaje);

        $datosCarrusel = request()->except(['_token','_method']);
        if ($request->hasFile('Imagen')) {
            $carrusel=Carrusel::findOrFail($id);
            Storage::delete($carrusel->Imagen);
            $imagen = $request->file('Imagen');
            $carpetaDestino = storage_path('app/public/uploads');
            $rutaImagen = $imagen->store('public/uploads');
            $datosCarrusel['Imagen'] = $rutaImagen;
        }

        Carrusel::where('id','=',$id)->update($datosCarrusel);
        $carrusel=Carrusel::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('carrusel')->with('mensaje','Imagen modificada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carrusel = Carrusel::findOrFail($id);
        if (Storage::delete($carrusel->Imagen)) {
            Carrusel::destroy($id);
        }

        return redirect('carrusel')->with('mensaje', 'Imagen borrada');
    }
}
