@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Escalafon</h1>
@stop
    
@section('content')
<div class='container'>
    <div class="card">
        <div class='card-body'>
            <form action="{{url('/escalafon/'.$escalafon->id)}}" method="post"  enctype="multipart/form-data">
                @csrf
                {{method_field('PATCH')}}
                @include('escalafon.form',['modo'=>'Editar'])
    
            </form>
        </div>
 </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

