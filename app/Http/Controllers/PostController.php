<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Mensaje;
use App\Models\Area;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $datos['carrusels'] = Session::get('carrusel_data.carrusels', []);
        $datos['numImages'] = Session::get('carrusel_data.numImages', 3);
        
       $posts = Post::where('status', 2)->latest('id')->paginate(9);
       /* $areas = Area::all(); */
       return view('posts.index', compact('posts'/* , 'areas' */));
    }
    /* controlador para mostrar los post */
    public function show(Post $post){

        $datos['carrusels'] = Session::get('carrusel_data.carrusels', []);
        $datos['numImages'] = Session::get('carrusel_data.numImages', 3);
       
        $areas = Area::all();
        $this->authorize('published', $post);

        $similares = Post::where('category_id', $post->category_id)
                            ->where('status', 2)
                            ->where('id', '!=', $post->id)
                            ->latest('id')
                            ->take(4)
                            ->get();

        return view('posts.show', compact('post', 'similares', 'areas'));
    }

    public function category(category $category ){
        $posts = Post::where('category_id', $category->id)
                        ->where('status',2)
                        ->latest('id')
                        ->paginate(6);
        return view('posts.category', compact('posts', 'category'));
    }
    /* Mensajes */
    

    public function enviarMensaje(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'contacto' => 'required',
            'area_id' => 'required',
            'mensaje' => 'required',
            
        ]);

        Mensaje::create($request->all());

        return redirect()->back()->with('success', 'Mensaje enviado correctamente');
    }

    public function destroy($id)
    {
        $mensaje = Mensaje::findOrFail($id);
        $mensaje->delete();

        return redirect()->back()->with('success', 'El mensaje ha sido eliminado correctamente.');
    }
}


