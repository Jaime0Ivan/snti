@extends('layouts.vertical')
@section('content')
@include('layouts.slidert')

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    @foreach($comisiones as $comisione)
        <div class="mx-4 mt-4">
            <div class="text-2xl font-bold text-center">{!! $comisione->Titulo !!}</div>
            <div class="text-base text-gray-500 mt-4">{!! $comisione->Texto !!}</div>
        </div>
    @endforeach
</div>


@include('layouts.pie')
@endsection