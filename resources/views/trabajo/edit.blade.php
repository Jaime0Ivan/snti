
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Trabajo</h1>
@stop
    
@section('content')
<div class='container'>
    <div class='card'>
        <div class='card-body'>
    <form action="{{url('/trabajo/'.$trabajo->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('trabajo.form',['modo'=>'Editar'])
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