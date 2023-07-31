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
<!--  the Tailwind CSS stylesheet -->

<div class='titulo'>
  <h1 class='text-2xl font-bold'>Secretaria de Escalafon</h1>
</div>

<div class="centered-container mt-4">
  <div class="flex flex-col md:flex-row items-center md:justify-between mb-2">
      <label for="orden" class="mr-2">Orden alfabético:</label>
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

<!-- Assuming you have included the Tailwind CSS stylesheet -->

<div class="finanzas-container grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
  @foreach($escalafons as $escalafon)
      <div class="finanza-item border rounded-lg p-4 bg-white shadow-md w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/3" data-nombre="{{ $escalafon->Nombre }}">
          @php
              $extension = pathinfo($escalafon->Archivo, PATHINFO_EXTENSION);
              $imagePath = asset('images/'.$extension.'.png');
          @endphp
          <img src="{{ $imagePath }}" alt="{{ strtoupper($extension) }}" class="w-12 h-12 mx-auto mb-2">

          @if ($escalafon->password)
              <a href="{{ url(str_replace('public/', '', 'storage/'.$escalafon->Archivo)) }}" class="archivo-link text-blue-500" data-password="{{ $escalafon->password }}">
                  <p class="text-xl font-bold text-blue-500 hover:underline">{{ $escalafon->Nombre }}</p>
              </a>
          @else
              <a href="{{ url(str_replace('public/', '', 'storage/'.$escalafon->Archivo)) }}" class="archivo-link text-blue-500">
                  <p class="text-xl font-bold text-blue-500 hover:underline">{{ $escalafon->Nombre }}</p>
              </a>
          @endif

          <p class="text-gray-600 text-sm">{{ $escalafon->Descripcion }}</p>
          <p class="text-gray-600 text-sm">{{ Carbon::parse($escalafon->created_at)->format('d/m/Y') }}</p>
      </div>
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
