@extends('layouts.vadmin')
@section('content')
    <style>
        *{
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .titulo{
        margin-top:2.5%;
        text-align:center;
        }

        .encabezado {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 18%;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url({{ asset('images/fondoe.png') }});
            color: black;
            opacity:55%;
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
            color: black; /* Ajusta el padding según tus necesidades */
            padding-left: 20px;
            padding-top: 5px;
            padding-right: 20px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        /* Estilo para el botón de borrar */
        .container-i table tbody td .btn-danger {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: 1px solid white;
            border-radius: 4px;
            transition: background-color 0.3s;
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
    </style>
    <div class='container-i'>
    <div class='titulo'>
        <h1>Logo</h1>
    </div>
        <a href="{{ url('logo/create') }}" class='btn btn-success'>Modificar logo</a>
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logos as $logo)
                    <tr>
                        <td>{{ $logo->id }}</td>
                        <td>
                        <img class='img-thumbnail img-fluid' src="{{ url(str_replace('public/', '', 'storage/'.$logo->Logo)) }}" width="100">
                        </td>
                        <td>
                        <a href="{{url('logo/' .$logo->id. '/edit')}}" class='btn btn-warning'>
                            Editar
                        </a> 
                            <form action="{{ url('logo/'.$logo->id) }}" class='d-inline' method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class='btn btn-danger' type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $logos->links() !!}
    </div>
@endsection
