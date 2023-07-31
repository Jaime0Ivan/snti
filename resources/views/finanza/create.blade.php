
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Finanza </h1>
@stop
    
@section('content')
<div class='container'>
    <div class='card'>
        <div class='card-body'>
            <form action="{{url('/finanza')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('finanza.form', ['modo' => 'Subir'])
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