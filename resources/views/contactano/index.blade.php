@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>Contactanos</h1>
</div>
<div class='container-i'>
    <a href="{{ url('contactano/create') }}" class='btn btn-success'>Texto</a>
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
            @foreach($contactanos as $contactano)
                <tr>
                    <td>{{ $contactano->id }}</td>
                    <td>{{ $contactano->Titulo }}</td>
                    <td>{!! $contactano->Texto !!}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{url('/contactano/' .$contactano->id. '/edit')}}" class='btn btn-warning'>
                                Editar
                            </a>
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $contactanos->links() !!}
</div>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop