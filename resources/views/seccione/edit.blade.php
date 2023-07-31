
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Secciones sindicales</h1>
@stop
    
@section('content')
<div class='container'>
    <div class='card'>
        <div class='card-body'>
    <form action="{{url('/seccione/'.$seccione->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('seccione.form',['modo'=>'Editar'])
        
    </form>
        </div>
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
    .create( document.querySelector( '#Descripcion' ) )
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