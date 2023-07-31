
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Secciones sindicales</h1>
</div>
<div class="container-i">
    <a href="{{ url('seccione/create') }}" class="btn btn-success mb-2">Subir archivo</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Archivo</th>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Subtitulo</th>
                    <th>Texto</th>
                    <th>Fecha</th>
                    <th>Contraseña</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($secciones as $seccione)
                    <tr>
                        <td>{{ $seccione->id }}</td>
                        <td>
                            @if ($seccione->password)
                                <a href="{{ url(str_replace('public/', '', 'storage/'.$seccione->Archivo)) }}" class="archivo-link" data-password="{{ $seccione->password }}">
                                    {{ $seccione->Nombre }}
                                </a>
                            @else
                                <a href="{{ url(str_replace('public/', '', 'storage/'.$seccione->Archivo)) }}">
                                    {{ $seccione->Nombre }}
                                </a>
                            @endif
                        </td>
                        <td>{!! $seccione->Titulo !!}</td>
                        <td>{!! $seccione->Descripcion !!}</td>
                        <td>{!! $seccione->Subtitulo !!}</td>
                        <td>{!! $seccione->Texto !!}</td>
                        <td>{{ $seccione->created_at }}</td>
                        <td>
                            @if ($seccione->password)
                                <i class="lock-icon fas fa-lock"></i>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{url('/seccione/' .$seccione->id. '/edit')}}" class='btn btn-warning'>
                                    Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $secciones->links() !!}
</div>

@stop

@section('css')

@stop

@section('js')
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
</script>
@stop
