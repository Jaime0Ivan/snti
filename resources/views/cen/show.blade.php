@extends('layouts.vertical')
@section('content')


<!DOCTYPE html>
<html>
<head>
    <title>Ventana con Título y Texto</title>
</head>
<body>
    @foreach ($collection as $item)
        
    @endforeach
    <h1>{{ $comisiones->Titulo }}</h1>
    <p>{{ $comisiones->Texto }}</p>
</body>
</html>

@include('layouts.pie')
@endsection