@extends('layouts.app')
@section('content')
<div class='container'>
<div class='row justify-content-center'>
    <div class='col-lg-5'>
<form action="{{url('pie/'.$pie->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    @include('pie.form',['modo'=>'Editar'])
</form>
</div>
</div>
</div>
@endsection