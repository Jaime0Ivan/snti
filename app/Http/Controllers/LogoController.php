<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = Logo::paginate(5);
        return view('logo.index', compact('logos'));
    }
    
    
    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('logo.create');
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $campos=[
                'Logo'=>'required|max:100000|mimes:jpeg,png,jpg'
            ];
    
            $mensaje=[
                'Logo.required'=>'La foto es requerida'
            ];
    
            $this->validate($request,$campos,$mensaje);
    
            $datosLogo = $request->except('_token');
            
            if ($request->hasFile('Logo')) {
                $logo = $request->file('Logo');
                $carpetaDestino = storage_path('app/public/logos');
    
                // Verificar permisos de la carpeta
                if (!is_writable($carpetaDestino)) {
                    // Otorgar permisos de escritura si no los tiene
                    chmod($carpetaDestino, 0755);
                }
    
                $rutaLogo = $logo->store('public/logos');
                $datosLogo['Logo'] = $rutaLogo;
            }
            
            Logo::insert($datosLogo);
            return  redirect('logo')->with('mensaje','Logo agregado con exito');
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
            $logo=Logo::findOrFail($id);
            return view('logo.edit', compact('logo'));
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id)
        {
            $campos=[];
            $mensaje=[];
    
            if ($request->hasFile('Logo')) {
                $campos['Logo'] = 'required|max:100000|mimes:jpeg,png,jpg';
                $mensaje['Logo.required'] = 'El logo es requerido';
            }
    
            $this->validate($request,$campos,$mensaje);
    
            $datosLogo = request()->except(['_token','_method']);
            if ($request->hasFile('Logo')) {
                $logo=Logo::findOrFail($id);
                Storage::delete($logo->Logo);
                $logo = $request->file('Logo');
                $carpetaDestino = storage_path('app/public/logos');
                $rutaLogo = $logo->store('public/logos');
                $datosLogo['Logo'] = $rutaLogo;
            }
    
            Logo::where('id','=',$id)->update($datosLogo);
            $logo=Logo::findOrFail($id);
            //return view('empleado.edit', compact('empleado'));
            return redirect('logo')->with('mensaje','logo modificado');
        }
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id)
        {
            $logo = Logo::findOrFail($id);
            if (Storage::delete($logo->Logo)) {
                Logo::destroy($id);
            }
    
            return redirect('logo')->with('mensaje', 'Imagen borrada');
        }
}