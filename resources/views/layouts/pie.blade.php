{{-- @vite('resources/css/pies.css') --}}
<footer class="pie-pagina bg-slate-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-3 gap-4">
        <div class="col-span-1">
            <h2 class="text-orange-600 text-2xl font-bold">{{ 'Propósito del SNTIFSTSE:' }}</h2>
            <p class="text-base text-gray-200">
                {{ 'El propósito fundamental del Sindicato será defender los derechos de los Trabajadores, conseguir mejores condiciones generales de trabajo y prestaciones socioeconómicas.' }}
            </p>
        </div>
        <div class="flex justify-center items-center col-span-1">
            <div class="box">
                <h2 class="text-orange-600 text-xl font-bold">ENLACES</h2>
                <div>
                    <a href="{{ url('acerca/show') }}" class="text-gray-200 aenlaces">Acerca de nosotros</a>
                </div>
                <div>
                    <a href="{{ url('contactano/show') }}" class="text-gray-200 aenlaces">Contáctanos</a>
                </div>
                <div>
                    <a href="{{ url('ubicacion/show') }}" class="text-gray-200 aenlaces">Ubicación</a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center col-span-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img class="h-28 w-28" src="{{ asset('images/logosin.png') }}" alt="Logo">
                    </a>
                </figure>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mt-4">
        <small class="text-gray-200">&copy; 2023 <b>SNTI</b> - Todos los Derechos Reservados</small>
    </div>
</footer>
