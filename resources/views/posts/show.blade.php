@extends('layouts.vertical')
    <!-- show.blade.php -->
<style>
    
    .custom-container {
            width: 70px; /* El tamaño en píxeles que desees para el ancho */
            height: 50px; /* El tamaño en píxeles que desees para la altura */
        }
</style>
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 ">
        <h1 class="text-4xl font-bold text-gray-600">{{$post->name}}</h1>

        <div class="text-lg text-gray-500 mb-2">
            {!!$post->extract!!}
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" >
            {{-- contenido principal --}}
            <div class="lg:col-span-2">
                <div class="flex flex-wrap -mx-2"> <!-- Utilizamos flex-wrap y -mx-2 para envolver las imágenes en un flexbox con espacio negativo para crear un margen entre las imágenes -->
                    @if ($post->image->count() > 0)
                        @foreach ($post->image as $image)
                            <div class="w-1/6 px-2"> <!-- Cambiar el ancho del contenedor a w-1/6 -->
                                <div class="custom-container relative">
                                    <img class="w-full h-full object-center opacity-80 cursor-pointer transition-opacity duration-300 hover:opacity-100" src="{{ Storage::url($image->url) }}" alt="" onclick="myFunction(this);">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-full">
                            <img class="w-full h-80 object-center" src="https://cdn.pixabay.com/photo/2023/02/07/13/55/forest-7774205_1280.jpg" alt="">
                        </div>
                    @endif
                </div>
                {{-- Contenedor para ver amplio las imágenes (movido al lado derecho) --}}
            <div class="lg:col-span-1 relative">
                <span onclick="this.parentElement.style.display='none'" class="absolute top-0 right-0 mt-2 mr-2 text-white text-2xl cursor-pointer">&times;</span>
                <img id="expandedImg" class="w-full">
                <div id="imgtext" class="absolute bottom-0 left-0 p-2 text-white text-sm"></div>
            </div>
            <div class="text-base text-gray-500 mt-4">
                {!!$post->body!!}
            </div>

            {{-- Enviar mensaje --}}
            <div class="max-w-md mx-auto px-4 py-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <form action="{{ route('mensaje.enviar') }}" method="POST">
                    @csrf
            
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required class="w-full px-3 py-2 border border-gray-300 rounded">
                    </div>
            
                    <div class="mb-4">
                        <label for="contacto" class="block text-gray-700">Contacto:</label>
                        <input type="text" id="contacto" name="contacto" required class="w-full px-3 py-2 border border-gray-300 rounded">
                    </div>
            
                    <div class="mb-4">
                        <label for="mensaje" class="block text-gray-700">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded"></textarea>
                    </div>
            
                    <div class="mb-4">
                        <label for="area" class="block text-gray-700">Área:</label>
                        <select id="area_id" name="area_id" class="w-full px-3 py-2 border border-gray-300 rounded">
                            <option value="">Seleccionar área</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar mensaje</button>
                </form>
            </div>
            
        </div> 
        {{-- contenido relacionado --}}
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Mas en {{$post->category->name}}</h1>

                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-4 ">
                            <a href="{{route('posts.show', $similar)}}">
                                @if ($similar->image && $similar->image->count() > 0)
                                <img class="w-36 h-20 object-cover object-center" src="{{ Storage::url($similar->image->first()->url) }}" alt="">
                            @else
                                <img class="w-36 h-20 object-cover object-center" src="https://cdn.pixabay.com/photo/2023/02/07/13/55/forest-7774205_1280.jpg" alt="">
                            @endif
                            <span class="ml-2 text-gray-600">{{$similar->name}}</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </aside>
            </div>
            
            
            
                
            
               

            

        </div>

    </div>

    <script>
        function myFunction(img) {
            var expandImg = document.getElementById("expandedImg");
            var imgText = document.getElementById("imgtext");
            expandImg.src = img.src;
            imgText.innerHTML = img.alt;
            expandImg.parentElement.style.display = "block";
        }
    </script>
