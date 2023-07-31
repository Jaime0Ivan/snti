<x-app-layout>
    <div class="mx-auto max-w-5xl px-2 sm:px-6 lg:px-8 py-8 ">

        <h1 class="uppercase text-center text-3xl font-bold">Categoria: {{$category->name}}</h1>

        @foreach ($posts as $post)
    <article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
        @if ($post->image && $post->image->first())
            <img src="{{ asset('storage/' . $post->image->first()->url) }}" alt="Imagen del post" class="w-full h-72 object-cover object-center">
        @else
            <img src="https://cdn.pixabay.com/photo/2023/02/07/13/55/forest-7774205_1280.jpg" alt="Imagen por defecto" class="w-full h-72 object-cover object-center">
        @endif
        <div class="px-6 py-4">
            <h1 class="font-bold text-xl mb-2">
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">{{ $post->name }}</a>
            </h1>
            @php
                echo $post->extract; // Imprimir el extracto sin la etiqueta <p>
            @endphp
        </div>
        
    </article>
@endforeach

        <div class="mt4">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>