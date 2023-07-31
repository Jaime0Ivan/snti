@extends('layouts.vertical')
@section('content')
@include('layouts.slidert')

@php
use Carbon\Carbon;
@endphp

<style>
    .titulo{
      margin-top:2.5%;
      text-align:center;
    }
    
    .finanzas-container {
      display: flex;
      flex-wrap: wrap;
      width:100%;
      margin-top:2.5%;
      justify-content:center;
      margin-buttom:2.5%;
    }
    
    .finanza-item {
      display: flex;
      max-width: 10%;
      flex-direction: column;
      align-items: center;
    }
    
    .finanza-item img {
      width: 100px; /* Ajusta el tamaño según tus necesidades */
      height: 100px;
    }
    
    .finanza-item a {
      margin-top: 5px;
      text-align: center;
    }
    
    .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
    
        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    
        .form-control {
            border-color: #d77813;
            background: #fdf2e6;
            box-shadow: 0 0 5px #d77813;
            outline: 0;
        }
    
        .form-control:focus {
            border-color: #d77813;
            background: #fdf2e6;
            box-shadow: 0 0 5px #d77813;
            outline: 0;
        }
    
        .btn-primary {
            background: #d77813;
            border-color: #d77813;
        }
    
        .btn-primary:hover {
            background: #d77813;
            border-color: #d77813;
        }
    
        @media screen and (max-width: 800px) {
          .finanzas-container {
            display: flex;
            flex-wrap: wrap;
            width:100%;
            margin-top:2.5%;
            margin-buttom:2.5%;
            justify-content:center;
          }
          .finanza-item {
            display: flex;
            max-width: 30%;
            flex-direction: column;
            align-items: center;
          }
         
    }
    
    </style>
<!-- Assuming you have included the Tailwind CSS stylesheet -->

<div class="titulo">
    <h1 class="text-2xl font-bold">Normateca</h1>
</div>
<div class="centered-container">
    <div>
        <label for="orden">Orden alfabético:</label>
        <select id="orden" name="orden" class="form-select">
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
        </select>
    </div>

    <form id="search-form" method="GET" action="{{ Request::url() }}" class="flex items-center mt-4 md:mt-0">
        <input type="text" name="busqueda" id="busqueda" class="w-full md:w-64 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300" placeholder="Buscar por Nombre, Descripción o Fecha">
        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Buscar</button>
    </form>
</div>

<h2 class="text-2xl font-bold mt-4">SECRETARIA GENERAL DEL SNTI</h2>
<div class="finanzas-container grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @foreach($normatecas as $normateca)
        @if($normateca->opcion === 'SECRETARIA GENERAL DEL SNTI')
        <div class="finanza-item border rounded-lg p-4 bg-white shadow-md">
            @php
                $extension = pathinfo($normateca->Archivo, PATHINFO_EXTENSION);
                $imagePath = asset('images/'.$extension.'.png');
            @endphp
            <img src="{{ $imagePath }}" alt="{{ strtoupper($extension) }}" class="w-12 h-12 mx-auto mb-2">

            @if ($normateca->password)
                <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link text-blue-500" data-password="{{ $normateca->password }}">
                    <p class="text-xl font-bold text-blue-500 hover:underline">{{ $normateca->Nombre }}</p>
                </a>
            @else
                <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link text-blue-500">
                    <p class="text-xl font-bold text-blue-500 hover:underline">{{ $normateca->Nombre }}</p>
                </a>
            @endif

            <p class="text-gray-600 text-sm">{{ $normateca->Descripcion }}</p>
            <p class="text-gray-600 text-sm">{{ Carbon::parse($normateca->created_at)->format('d/m/Y') }}</p>
        </div>
        @endif
    @endforeach
</div>

<h2 class="text-2xl font-bold mt-4">REGLAMENTOS</h2>
<div class="finanzas-container grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @foreach($normatecas as $normateca)
        @if($normateca->opcion === 'REGLAMENTOS')
        <div class="finanza-item border rounded-lg p-4 bg-white shadow-md">
            @php
                $extension = pathinfo($normateca->Archivo, PATHINFO_EXTENSION);
                $imagePath = asset('images/'.$extension.'.png');
            @endphp
            <img src="{{ $imagePath }}" alt="{{ strtoupper($extension) }}" class="w-12 h-12 mx-auto mb-2">

            @if ($normateca->password)
                <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link text-blue-500" data-password="{{ $normateca->password }}">
                    <p class="text-xl font-bold text-blue-500 hover:underline">{{ $normateca->Nombre }}</p>
                </a>
            @else
                <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link text-blue-500">
                    <p class="text-xl font-bold text-blue-500 hover:underline">{{ $normateca->Nombre }}</p>
                </a>
            @endif

            <p class="text-gray-600 text-sm">{{ $normateca->Descripcion }}</p>
            <p class="text-gray-600 text-sm">{{ Carbon::parse($normateca->created_at)->format('d/m/Y') }}</p>
        </div>
        @endif
    @endforeach
</div>

<h1 class="text-2xl font-bold mt-4">"POR LA UNIDAD, LA LUCHA SOCIAL Y EL INDIGENISMO"</h1>

<h2 class="mt-4">INFORMACIÓN JURISPRUDENCIA 1/96</h2>
<div class="finanzas-container grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @foreach($normatecas as $normateca)
        @if($normateca->opcion === 'INFORMACIÓN JURISPRUDENCIA')
        <div class="finanza-item border rounded-lg p-4 bg-white shadow-md">
            @php
                $extension = pathinfo($normateca->Archivo, PATHINFO_EXTENSION);
                $imagePath = asset('images/'.$extension.'.png');
            @endphp
            <img src="{{ $imagePath }}" alt="{{ strtoupper($extension) }}" class="w-12 h-12 mx-auto mb-2">

            @if ($normateca->password)
                <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link text-blue-500" data-password="{{ $normateca->password }}">
                    <p class="text-xl font-bold text-blue-500 hover:underline">{{ $normateca->Nombre }}</p>
                </a>
            @else
                <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link text-blue-500">
                    <p class="text-xl font-bold text-blue-500 hover:underline">{{ $normateca->Nombre }}</p>
                </a>
            @endif

            <p class="text-gray-600 text-sm">{{ $normateca->Descripcion }}</p>
            <p class="text-gray-600 text-sm">{{ Carbon::parse($normateca->created_at)->format('d/m/Y') }}</p>
        </div>
        @endif
    @endforeach
</div>

<script>
    // Obtener todos los enlaces de archivo con la clase "archivo-link"
    const archivoLinks = document.querySelectorAll('.archivo-link');

    // Agregar un manejador de eventos para cada enlace
    archivoLinks.forEach(archivoLink => {
        archivoLink.addEventListener('click', function(event) {
            event.preventDefault();

            // Obtener la contraseña del atributo "data-password"
            const password = archivoLink.dataset.password;

            // Verificar si se requiere contraseña
            if (password) {
                // Mostrar la ventana emergente de solicitud de contraseña
                const userPassword = prompt('Ingrese la contraseña:');

                // Verificar si la contraseña es correcta
                if (userPassword !== password) {
                    alert('Contraseña incorrecta');
                    return;
                }
            }

            // Redirigir al enlace del archivo si la contraseña es correcta o no se requiere contraseña
            window.location.href = archivoLink.href;
        });
    });
/*-----------------------------------------------------------------------------------------------------*/
    const ordenSelect = document.getElementById('orden');
    ordenSelect.addEventListener('change', function() {
      ordenarFinanzas();
    });

    function ordenarFinanzas() {
      const finanzasContainer = document.querySelector('.finanzas-container');
      const ordenSelect = document.getElementById('orden');
      const orden = ordenSelect.value;

      const finanzasItems = Array.from(finanzasContainer.querySelectorAll('.finanza-item'));
      finanzasItems.sort(function(a, b) {
        const nombreA = a.dataset.nombre.toUpperCase();
        const nombreB = b.dataset.nombre.toUpperCase();

        if (orden === 'asc') {
          if (nombreA < nombreB) {
            return -1;
          }
          if (nombreA > nombreB) {
            return 1;
          }
        } else if (orden === 'desc') {
          if (nombreA > nombreB) {
            return -1;
          }
          if (nombreA < nombreB) {
            return 1;
          }
        }
        return 0;
      });

      finanzasItems.forEach(function(item) {
        finanzasContainer.appendChild(item);
      });
    }
</script>
@include('layouts.pie')
@endsection
