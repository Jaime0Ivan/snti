<style>
    .form-control:focus {
        border-color: #d77813;
        background: #fdf2e6;
        box-shadow: 0 0 5px #d77813;
        outline: 0;
    }

    .btnn {
        background: #d77813;
        border-color: #d77813;
    }

    .btnn:hover {
        background: #d77813;
        border-color: #d77813;
    }
</style>
<div class='form-container'>
    <h1 class='text-center'>{{$modo}} imagen</h1>
    @if(count($errors)>0)
    <div class='alert alert-danger' role='alert'>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class='form-group text-center'>
    @if(isset($carrusel->Imagen))
    <img class='img-thumbnail img-fluid mb-2' src="{{ url(str_replace('public/', '', 'storage/'.$carrusel->Imagen)) }}" width="100%">
    @endif
    <input class='form-control' type="file" name="Imagen" value="" id='Imagen'>
    </div>

    <div class='d-grid col-lg mx-auto mt-2'>
    <input class='btn btn-success' type="submit" value="{{$modo}} datos">
    </div>
    <div class='d-grid col-lg mx-auto mt-2'>
    <a class='btn btn-primary' href="{{url('carrusel/')}}">Regresar</a>
    </div>
</div>
