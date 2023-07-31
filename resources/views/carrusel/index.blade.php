
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Carrusel</h1>
@stop
    
@section('content')

@include('layouts.slider')


<div class='container-i mt-4'>
<div class='titulo'>
    <h1>Carrusel de imagenes</h1>
</div>
    <a href="{{ url('carrusel/create') }}" class='btn btn-success'>Subir imagen</a>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrusels as $carrusel)
                <tr>
                    <td>{{ $carrusel->id }}</td>
                    <td>
                    <img class='img-thumbnail img-fluid' src="{{ url(str_replace('public/', '', 'storage/'.$carrusel->Imagen)) }}" width="100">
                    </td>
                    <td>
                    <a href="{{url('carrusel/' .$carrusel->id. '/edit')}}" class='btn btn-warning'>
                        Editar
                    </a> 
                        <form action="{{ url('carrusel/'.$carrusel->id) }}" class='d-inline' method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input class='btn btn-danger' type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $carrusels->links() !!}
</div>
@stop

@section('css')
 
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
