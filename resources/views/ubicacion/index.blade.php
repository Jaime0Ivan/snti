
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Ubicacion</h1>
</div>
<div class='container-i'>
    <a href="{{ url('ubicacion/create') }}" class='btn btn-success'>Texto</a>
    <br>
    <br>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>Texto</th>
                <th>accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ubicacions as $ubicacion)
                <tr>
                    <td>{{ $ubicacion->id }}</td>
                    <td>{{ $ubicacion->Titulo }}</td>
                    <td>{!! $ubicacion->Texto !!}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{url('/ubicacion/' .$ubicacion->id. '/edit')}}" class='btn btn-warning'>
                                Editar
                            </a>
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $ubicacions->links() !!}
</div>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
