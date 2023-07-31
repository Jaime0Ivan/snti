
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Cen y comisiones nacionales</h1>
@stop
    
@section('content')
<div class='card'>
    <div class='card-body'>
        
    <form action="{{url('/comisione/'.$comisione->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        {{-- @include('comisione.form',['modo'=>'Editar']) --}}
        <div class="form-group">
            {!! Form::label('Titulo', 'Titulo') !!}
            {!! Form::textarea('Titulo', isset($comisione->Titulo) ? $comisione->Titulo : old('Titulo'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}


            @error('Titulo')
                <span class="text-danger">{{$message}}</span>
                
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('Texto', 'Texto') !!}
            {!! Form::textarea('Texto', isset($comisione->Texto) ? $comisione->Texto : old('Texto'), ['class' => 'form-control', 'placeholder' => 'Ingrese el texto']) !!}


            @error('Texto')
                <span class="text-danger">{{$message}}</span>
                
            @enderror
        </div>
        {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
    </form>
        
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

