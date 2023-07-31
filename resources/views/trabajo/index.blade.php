
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Secretaria de Trabajo, Conflicto y Accion Politica</h1>
</div>
<div class='container-i'>
    <a href="{{ url('trabajo/create') }}" class='btn btn-success'>Subir archivo</a>
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
            @foreach($trabajos as $trabajo)
                <tr>
                    <td>{{ $trabajo->id }}</td>
                    <td>
                        @if ($trabajo->password)
                            <a href="{{ url(str_replace('public/', '', 'storage/'.$trabajo->Archivo)) }}" class="archivo-link" data-password="{{ $trabajo->password }}">
                                {{ $trabajo->Nombre }}
                            </a>
                        @else
                            <a href="{{ url(str_replace('public/', '', 'storage/'.$trabajo->Archivo)) }}">
                                {{ $trabajo->Nombre }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $trabajo->Descripcion }}</td>
                    <td>{{ $trabajo->created_at }}</td>
                    <td>
                        @if ($trabajo->password)
                            <i class="lock-icon fas fa-lock"></i>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{url('/trabajo/' .$trabajo->id. '/edit')}}" class='btn btn-warning'>
                                Editar
                            </a>
                            <form action="{{ url('/trabajo/'.$trabajo->id) }}" class='d-inline' method="post">
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
    {!! $trabajos->links() !!}
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
