<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\PostRequest;
use App\Models\Image;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Contracts\Cache\Store;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $tags = Tag ::all();
        /* metodo pluck para tomar solo un campo de categorias */
        $categories = Category::pluck('name', 'id');
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
    $post = Post::create($request->all());

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $images) {
            $url = $images->store('posts', 'public');

            $post->image()->create([
                'url' => $url
            ]);
        }
    }

    return redirect()->route('admin.posts.edit', $post);
}


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        $this->Authorize('author', $post);

        $categories = Category::pluck('name', 'id');

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {

        $this->Authorize('author', $post);

        $post->update($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $images) {
                $url = $images->store('posts', 'public');

                $post->image()->create([
                    'url' => $url,
                ]);
            }
        }
        return redirect()->route('admin.posts.edit',$post)->with('info', 'el post se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $this->Authorize('author', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('info', 'la noticia se elimino con exito');
    }
    public function destroyImage(Image $image)
    {
        Storage::delete($image->url);

        $image->delete();

        return redirect()->back()->with('success', 'Imagen eliminada.');
    }

    
}
