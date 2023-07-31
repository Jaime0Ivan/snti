@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Mostrar Mensajes</h1>
@stop

@section('content')
<div class="container">
    <h1>Mensajes recibidos</h1>

    @if ($mensajes->isEmpty())
        <p>No hay mensajes recibidos.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Área</th>
                    <th>Mensaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensajes as $mensaje)
                    <tr>
                        <td>{{ $mensaje->created_at }}</td>
                        <td>{{ $mensaje->nombre }}</td>
                        <td>{{ $mensaje->contacto }}</td>
                        <td>{{ $mensaje->area->nombre }}</td>
                        <td>{{ $mensaje->mensaje }}</td>
                        <td>
                            <form action="{{ route('admin.mensajes.destroy', $mensaje->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop