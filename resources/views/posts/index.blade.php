@extends('layouts.vertical')
@section('content')
@include('layouts.slidert')
    {{-- vista en donde se muestran los todos los posts  --}}
<div class="max-w-7xl mx-auto px-2 sm:px-6 py-8">
    <div class='titulo'>
  <h1 class='text-2xl font-bold text-center mb-6'>Noticias</h1>
</div> <!-- Título "Noticias" -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <article class="w-full h-80 bg-cover bg-center" style="background-image: url(@if($post->image && $post->image->first()) {{ asset('storage/' . $post->image->first()->url) }} @else https://cdn.pixabay.com/photo/2023/02/07/13/55/forest-7774205_1280.jpg @endif)">
                <div class="w-full h-full px-8 flex flex-col justify-center">
                    <h1 class="text-4xl text-white leading-8 font-bold">
                        <a href="{{route('posts.show',$post)}}">
                            {{$post->name}}
                        </a>
                    </h1>
                </div>
            </article>   
        @endforeach
    </div>
    <div class="m-4">
        {{$posts->links()}}
    </div>
</div>

@include('layouts.pie')
@endsection  
