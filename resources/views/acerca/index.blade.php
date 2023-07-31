@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Acerca de </h1>
</div>
<div class='container-i'>
    <a href="{{ url('acerca/create') }}" class='btn btn-success'>Añadir</a>
    <br>
    <br>
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
            @foreach($acercas as $acerca)
                <tr>
                    <td>{{ $acerca->id }}</td>
                    <td>{{ $acerca->Titulo }}</td>
                    <td>{!! $acerca->Texto !!}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{url('/acerca/' .$acerca->id. '/edit')}}" class='btn btn-warning'>
                                Editar
                            </a>
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $acercas->links() !!}
</div>

@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

