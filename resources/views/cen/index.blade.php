
@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1></h1>
@stop
    
@section('content')
<div class='titulo'>
    <h1>CEN y Comisones Nacionales</h1>
</div>
<div class='container-i'>
    <a href="{{ url('cen/create') }}" class='btn btn-success'>Subir archivo</a>
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Texto</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comisiones as $comisione)
                    <tr>
                        <td>{{ $comisione->id }}</td>
                        <td>{{ $comisione->Titulo }}</td>
                        <td>{{ $comisione->Texto }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{url('/cen/' .$comisione->id. '/edit')}}" class='btn btn-warning'>
                                    Editar
                                </a>
                                <form action="{{ url('/cen/'.$comisione->id) }}" class='d-inline' method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input class='btn btn-danger' type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {!! $comisiones->links() !!}
</div>
@stop

@section('css')
<style>
    *{
    font-family: 'times new roman', sans-serif; font-size: 16px;
    }

    .titulo{
    margin-top:2.5%;
    text-align:center;
    }

    .container-i {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        text-align: center;
        
    }

    .container-i table {
        margin-top: 20px;
        width: 100%;
        max-width: 600px;
        border-collapse: collapse;
        border: 1px solid black;
        
    }

    /* Estilo para el encabezado de las columnas */
    .container-i table thead th {
        background-color: #d77813;
        color: white;
    }

    /* Estilo para las celdas y marcos */
    .container-i table tbody td,
    .container-i table tbody th {
        background-color: white;
        color: black;
        padding-bottom: 20px; /* Ajusta el padding según tus necesidades */
        padding-left: 20px;
        padding-right: 20px;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    /* Estilo para el botón de borrar */
    .container-i table tbody td .btn-danger {
        background-color: red;
        font-weight: bold;
        color: white;
        padding: 5px 10px;
        border: 1px solid white;
        border-radius: 4px;
        transition: background-color 0.3s;
        cursor: pointer;
    }

    .container-i table tbody td .btn-danger:hover {
        background-color: #ff4444;
    }

    /* Estilo para el botón de registro */
    .container-i a.btn-success {
        background-color: #32a852;
        color: white;
        padding: 5px 10px;
        border: 1px solid white;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .container-i a.btn-success:hover {
        background-color: #4ccd6d;
    }

    /* Estilo para la paginación */
    .container-i .pagination {
        margin-top: 20px;
        list-style: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container-i .pagination li {
        margin: 0 5px;
    }

    .container-i .pagination li a {
        display: block;
        padding: 5px 10px;
        background-color: #d77813;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .container-i .pagination li a:hover {
        background-color: #ff9800;
    }

    .container-i .pagination .active a {
        background-color: #ff9800;
    }

    /* Estilo para el enlace de editar */
    .container-i table tbody td .btn-warning {
        background-color: yellow;
        border: #d4af37;
        color: white;
        padding: 5px 10px;
        border: 1px solid white;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .container-i table tbody td .btn-warning:hover {
        background-color: #f2e65f;
    }

    .container-i table tbody td .btn-warning:focus {
        outline: none;
        text-decoration: none;
        color: white;
    }

    /* Espacio entre los botones */
    .container-i table tbody td .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Estilo para el icono de candado */
    .container-i table tbody td .lock-icon {
        color: #999999;
        margin-right: 5px;
    }
</style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop