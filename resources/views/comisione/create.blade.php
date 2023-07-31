
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Cen y comisiones nacionales</h1>
@stop
    
@section('content')
<div class='card'>
    <div class="card-body">
        {!! Form::open(['route' => 'comisione.store']) !!}

            <div class="form-group">
                {!! Form::label('Titulo', 'Titulo') !!}
                {!! Form::text('Titulo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}

                @error('name')
                    <span class="text-danger">{{$message}}</span>
                    
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('Texto', 'Texto') !!}
                {!! Form::text('Texto', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el texto']) !!}

                @error('name')
                    <span class="text-danger">{{$message}}</span>
                    
                @enderror
            </div>

            

            {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
    
</div>
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-lg-5'>
            <form action="{{url('/comisione')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('comisione.form', ['modo' => 'Subir'])
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


