
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class="titulo">
    <h1>CEN y Comisiones Nacionales</h1>
</div>

<div class="container-i">
    <a href="{{ url('comisione/create') }}" class="btn btn-success mb-2">Subir archivo</a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Texto</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comisiones as $comisione)
                    <tr>
                        <td>{{ $comisione->id }}</td>
                        <td>{!! $comisione->Titulo !!}</td>
                        <td>
                            <div class="text-break">
                                {!! $comisione->Texto !!}
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ url('/comisione/' .$comisione->id. '/edit') }}" class="btn btn-warning">
                                    Editar
                                </a>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
</div>

@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop