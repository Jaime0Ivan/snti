@extends('layouts.vertical')
@section('content')
@include('layouts.slidert')

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    @foreach($secciones as $seccione)
        <div class="mx-4 mt-4">
            <div class="text-2xl font-bold text-center">{{ $seccione->Titulo }}</div>
            <div class="text-base text-gray-500 mt-4">{!! $seccione->Descripcion !!}</div>
        </div>
        <div class="mx-4 mt-4">
            <div class="text-2xl font-bold text-center text-orange-400">{{ $seccione->Subtitulo }}</div>
            <div class="text-base text-gray-500 mt-4">{!! $seccione->Texto !!}</div>
        </div>
    @endforeach
</div>



@include('layouts.pie')
@endsection