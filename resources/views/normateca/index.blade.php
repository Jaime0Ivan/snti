@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Normateca</h1>
</div>
<div class='container-i'>
    <a href="{{ url('normateca/create') }}" class='btn btn-success'>Subir archivo</a>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Archivo</th>
                <th>Opcion</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Contraseña</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($normatecas as $normateca)
                <tr>
                    <td>{{ $normateca->id }}</td>
                    <td>
                        @if ($normateca->password)
                            <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}" class="archivo-link" data-password="{{ $normateca->password }}">
                                {{ $normateca->Nombre }}
                            </a>
                        @else
                            <a href="{{ url(str_replace('public/', '', 'storage/'.$normateca->Archivo)) }}">
                                {{ $normateca->Nombre }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $normateca->opcion }}</td>
                    <td>{{ $normateca->Descripcion }}</td>
                    <td>{{ $normateca->created_at }}</td>
                    <td>
                        @if ($normateca->password)
                            <i class="lock-icon fas fa-lock"></i>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{url('/normateca/' .$normateca->id. '/edit')}}" class='btn btn-warning'>
                                Editar
                            </a>
                            <form action="{{ url('/normateca/'.$normateca->id) }}" class='d-inline' method="post">
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
    <div class="card-footer">
        {{ $normatecas->links() }}
    </div>

    
    
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




