@extends('layouts.vertical')
@section('content')
@include('layouts.slidert')

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    @foreach($acercas as $acerca)
        <div class="mx-4 mt-4">
            <div class="text-2xl font-bold text-center">{!! $acerca->Titulo !!}</div>
            <div class="text-base text-gray-500 mt-4">{!! $acerca->Texto !!}</div>
        </div>
    @endforeach
</div>

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    @foreach($contactanos as $contacto)
        <div class="mx-4 mt-4">
            <div class="text-2xl font-bold text-center">{!! $contacto->Titulo !!}</div>
            <div class="text-base text-gray-500 mt-4">{!! $contacto->Texto !!}</div>
        </div>
    @endforeach
</div>

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    @foreach($ubicacions as $ubicacion)
        <div class="mx-4 mt-4">
            <div class="text-2xl font-bold text-center">{!! $ubicacion->Titulo !!}</div>
            <div class="text-base text-gray-500 mt-4">{!! $ubicacion->Texto !!}</div>
        </div>
    @endforeach
</div>


@include('layouts.pie')
@endsection