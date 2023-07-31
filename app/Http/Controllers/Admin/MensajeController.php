<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mensaje; 

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $mensajes = Mensaje::all();

        return view('admin.mensajes.index', compact('mensajes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mensaje $mensaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mensaje $mensaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mensaje $mensaje)
    {
        
        $mensaje->delete();

        return redirect()->route('admin.mensajes.index')->with('success', 'El mensaje ha sido eliminado correctamente.');
    }
    

}
