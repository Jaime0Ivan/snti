@extends('layouts.app')
@section('content')
<div class='container'>
<div class='row justify-content-center'>
    <div class='col-lg-5'>
<form action="{{url('logo/')}}" method="post" enctype="multipart/form-data">
    @csrf
   @include('logo.form',['modo'=>'Crear'])
</form>
</div>
</div>
</div>
@endsection