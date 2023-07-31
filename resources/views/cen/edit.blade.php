@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Cen y Comisiones</h1>
@stop
    
@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-lg-5'>
    <form action="{{url('/cen/'.$comisione->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('cen.form',['modo'=>'Editar'])
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