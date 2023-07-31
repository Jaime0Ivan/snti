@extends('layouts.app')
@section('content')
<div class='container'>
<div class='row justify-content-center'>
    <div class='col-lg-5'>
<form action="{{url('logo/'.$logo->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    @include('logo.form',['modo'=>'Editar'])
</form>
</div>
</div>
</div>
@endsection