

@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Acerca de</h1>
@stop
    
@section('content')
<div class='card'>
    <div class="card-body">
        {!! Form::open(['route' => 'acerca.store']) !!}

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
            <div class="d-grid col-lg mx-auto mt-2">
                <a class="btn btn-secondary" href="{{url('acerca/')}}">Regresar</a>
                </div>
        {!! Form::close() !!}
    </div>
    
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#Titulo' ) )
        .catch( error => {
            console.error( error );
        } ); 

ClassicEditor
        .create( document.querySelector( '#Texto' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@stop

