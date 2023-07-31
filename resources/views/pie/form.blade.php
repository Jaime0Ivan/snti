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
    @if(isset($pie->LogoP))
    <img class='img-thumbnail img-fluid mb-2' src="{{ url(str_replace('public/', '', 'storage/'.$pie->LogoP)) }}" width="100%">
    @endif
    <input class='form-control' type="file" name="LogoP" value="" id='LogoP'>
    </div>

    <div  class="form-floating mb-2">
        <input class="form-control fs-5"  placeholder="name@example.com" type="text" name="TituloT" value="{{isset($pie->TituloT)?$pie->TituloT:old('TituloT')}}" id="TituloT">
        <label class="fs-5 for="TituloT">Titulo</label>
    </div>

    <div class="form-floating mb-2">
    <textarea class="form-control" placeholder="Leave a comment here" name="Texto"  id="Texto">{{isset($pie->Texto)?$pie->Texto:old('Texto')}}</textarea>
        <label class="fs-5 for="Texto">Texto</label>
    </div >

    <div class='d-grid col-lg mx-auto mt-2'>
    <input class='btn btn-success' type="submit" value="{{$modo}} datos">
    </div>
    <div class='d-grid col-lg mx-auto mt-2'>
    <a class='btn btn-primary' href="{{url('pie/')}}">Regresar</a>
    </div>
</div>  
