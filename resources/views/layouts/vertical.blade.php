<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CSS -->
    @vite(['resources/css/menuv.css', 'resources/js/menuv.js'])
    <link rel="stylesheet" href="{{ asset('build/assets/app-db0c0d48.css') }}">
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="{{ asset('build/assets/app-ab9fb1ca.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="antialiased">
<div class="container">
    <span class="mif-chevron-left mif-3x boton">
       
        <img class='logo' src="{{asset('images/logo1.png')}}" alt="">
       
    </span>
    <nav>
        @auth
  <div class="profile-menu">
    <button type="button" class="profile-menu__notification-btn">
      <span class="sr-only"></span>
      <svg class="profile-menu__notification-icon" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
      </svg>
    </button>

    <div class="profile-menu__dropdown" x-data="{ open: false }">
      <div>
        <button x-on:click="open = true" type="button" class="profile-menu__user-btn" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
          <span class="sr-only"></span>
          <img class="profile-menu__user-avatar" src="{{ auth()->user()->profile_photo_url }}" alt="">
        </button>
      </div>

      <div x-show="open" x-on:click.away="open = false" class="profile-menu__dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Tu perfil</a>
        <a href="{{ route('admin.home') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Panel administrador</a>
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button type="submit" class="block px-4 py-2 text-sm text-gray-700" tabindex="-1">Cerrar Sesion</button>
          </form>
          
      </div>
    </div>
  </div>
@else
  <div class="login-links">
    <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Login</a>
  </div>
@endauth
        <ul id="menu_principal">
            <li><a href="/">Inicio</a></li>
            <li><a href="{{url('comisione/show')}}"><span>CEN y Comisiones Nacionales</span></a></li>
            <li>
                <label for="drop-1">
                    <span class="mif-cart mif-3x principales"></span>
                    Secretarias &#62
                    <span class="mif-chevron-right mif-2x derecha"></span>
                    <span class="mif-expand-more mif-2x derecha"></span>
                </label>
                {{-- <input type="checkbox" id="drop-1"> --}}
                <ul>
                    <li><a href="{{url('finanza/show')}}">Secretaria de finanzas</a></li>
                    <li><a href="{{url('prestacione/show')}}">Secretaria de prestaciones</a></li>
                    <li><a href="{{url('trabajo/show')}}">Secretaria de trabajo</a></li>
                    <li><a href="{{url('escalafon/show')}}">Secretaria de escalafon</a></li>
                </ul>
            </li>
            <li><a href="{{url('seccione/show')}}"><span>Secciones Sindicales</span></a></li>
            <li><a href="{{url('convocatoria/show')}}"><span>Convocatoria</span></a></li>
            <li><a href="{{url('normateca/show')}}"><span>Normateca</span></a></li>
            <li><a href="{{url('proceso/show')}}"><span>Proceso Electoral</span></a></li>
            

            
        </ul>
    </nav>
</div>



        

        <!-- CSS -->
        <main class="py-4">
            @yield('content')
        </main>
        
        </body>
</html>