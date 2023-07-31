@extends('layouts.app')
@section('content')
<div class='container'>
<div class='row justify-content-center'>
    <div class='col-lg-5'>
<form action="{{url('pie/')}}" method="post" enctype="multipart/form-data">
    @csrf
   @include('pie.form',['modo'=>'Crear'])
</form>
</div>
</div>
</div>
@endsection