
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Secretaria de Prestaciones Economicas</h1>
</div>
<div class='container-i'>
    <a href="{{ url('prestacione/create') }}" class='btn btn-success'>Subir archivo</a>
    <br>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Archivo</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Contraseña</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestaciones as $prestacione)
                <tr>
                    <td>{{ $prestacione->id }}</td>
                    <td>
                        @if ($prestacione->password)
                            <a href="{{ url(str_replace('public/', '', 'storage/'.$prestacione->Archivo)) }}" class="archivo-link" data-password="{{ $prestacione->password }}">
                                {{ $prestacione->Nombre }}
                            </a>
                        @else
                            <a href="{{ url(str_replace('public/', '', 'storage/'.$prestacione->Archivo)) }}">
                                {{ $prestacione->Nombre }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $prestacione->Descripcion }}</td>
                    <td>{{ $prestacione->created_at }}</td>
                    <td>
                        @if ($prestacione->password)
                            <i class="lock-icon fas fa-lock"></i>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{url('/prestacione/' .$prestacione->id. '/edit')}}" class='btn btn-warning'>
                                Editar
                            </a>
                            <form action="{{ url('/prestacione/'.$prestacione->id) }}" class='d-inline' method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class='btn btn-danger' type="submit" onclick="return confirm('¿Quieres borrar?')" value="Eliminar">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $prestaciones->links() !!}
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
