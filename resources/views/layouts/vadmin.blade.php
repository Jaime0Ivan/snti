<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CSS -->
    @vite(['resources/css/menuv.css', 'resources/js/menuv.js'])
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="antialiased">
<div class="container">
    <span class="mif-chevron-left mif-3x boton">
    <img class='logo' src="{{asset('images/logo1.png')}}" alt="">
       
    </span>
    <nav>
        <ul id="menu_principal">
            <li><a href="">Inicio</a></li>
            <li>
                <label for="drop-1">
                    <span class="mif-cart mif-3x principales"></span>
                    Configuracion de la pagina &#62
                    <span class="mif-chevron-right mif-2x derecha"></span>
                    <span class="mif-expand-more mif-2x derecha"></span>
                </label>
                <input type="checkbox" id="drop-1">
                <ul>
                    <li><a href="{{url('carrusel/')}}">Carrusel</a></li>
                    <li><a href="#">Pie de pagina</a></li>
                    <li><a href="#">Logo</a></li>
                    <li><a href="#">Cerrar sesion</a></li>
                </ul>
            </li>
            <li><a href="{{url('cen/')}}"><span>CEN y Comisiones Nacionales</span></a></li>
            <li>
                <label for="drop-1">
                    <span class="mif-cart mif-3x principales"></span>
                    Secretarias &#62
                    <span class="mif-chevron-right mif-2x derecha"></span>
                    <span class="mif-expand-more mif-2x derecha"></span>
                </label>
                <input type="checkbox" id="drop-1">
                <ul>
                    <li><a href="{{url('finanza/')}}">Secretaria de finanzas</a></li>
                    <li><a href="{{url('prestacione/')}}">Secretaria de prestaciones</a></li>
                    <li><a href="{{url('trabajo/')}}">Secretaria de trabajo</a></li>
                    <li><a href="{{url('escalafon/')}}">Secretaria de escalafon</a></li>
                </ul>
            </li>
            <li><a href="#"><span>Secciones Sindicales</span></a></li>
            <li><a href="{{url('convocatoria/index')}}"><span>Convocatoria</span></a></li>
            <li><a href="{{url('normateca/')}}"><span>Normateca</span></a></li>
            <li><a href="{{url('proceso/')}}"><span>Proceso Electoral</span></a></li>
        </ul>
    </nav>
</div>



        

        <!-- CSS -->
        <main class="py-4">
            @yield('content')
        </main>
        
        </body>
</html>