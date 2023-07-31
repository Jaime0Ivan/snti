<style>
    .form-control:focus{
            border-color: #d77813;
            background:#fdf2e6;
            box-shadow: 0 0 5px #d77813;
            outline: 0;
        }
        .btnn{
            background:#d77813;
            border-color:#d77813;
        }
        .btnn:hover{
            background:#d77813;
            border-color:#d77813;
        }
</style>

<div class="form-container">
    <h1  class="text-center">{{$modo}} archivo</h1>
    @if(count($errors)>0)
    <div class='alert alert-danger' role='alert'>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div  class="form-floating mb-2">
        <input class="form-control fs-5"  placeholder="name@example.com" type="text" name="Titulo" value="{{isset($comisione->Titulo)?$comisione->Titulo:old('Titulo')}}" id="Titulo">
        <label class="fs-5 for="Titulo">Titulo</label>
    </div>

    <div class="form-floating mb-2">
    <textarea class="form-control" placeholder="Leave a comment here" name="Texto"  id="Texto">{{isset($comisione->Texto)?$comisione->Texto:old('Texto')}}</textarea>
        <label class="fs-5 for="Texto">Texto</label>
    </div >
    
    <div class="d-grid col-lg mx-auto mt-2">
    <input class="btn btn-success" type="submit" value="datos">
    </div>
    <div class="d-grid col-lg mx-auto mt-2">
    <a class="btn btn-primary btnn" href="{{url('acerca/')}}">Regresar</a>
    </div>
</div>
