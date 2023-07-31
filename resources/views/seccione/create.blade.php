@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Secciones sindicales</h1>
@stop
    
@section('content')
<div class='container'>
    <div class='card'>
        <div class='card-body'>
            <form action="{{url('/seccione')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('seccione.form', ['modo' => 'Subir'])
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
