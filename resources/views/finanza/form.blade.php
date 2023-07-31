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


    <h1  class="text-center">{{$modo}} </h1>
    @if(count($errors)>0)
    <div class='alert alert-danger' role='alert'>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="mb-3">
        <input class="form-control fs-5" type="file" name="Archivo" value="{{isset($finanza->Archivo)?$finanza->Archivo:old('Archivo')}}" id="Archivo">
    </div>

    <div class="form-group">
        {!! Form::label('Nombre', 'Nombre:') !!}
        {!! Form::text('Nombre', isset($finanza->Nombre)?$finanza->Nombre:old('Nombre'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
    
    
        @error('Nombre')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Descripcion', 'Descripcion:') !!}
        {!! Form::text('Descripcion', isset($finanza->Descripcion)?$finanza->Descripcion:old('Descripcion'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
    
    
        @error('Descripcion')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    
    <div class="form-group">
        {!! Form::label('password', 'password:') !!}
        {!! Form::text('password', isset($finanza->password) ? $finanza->password : old('password'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
    
    
        @error('password')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    
    <div class="d-grid col-lg mx-auto mt-2">
    <input class="btn btn-success" type="submit" value="datos">
    </div>
    <div class="d-grid col-lg mx-auto mt-2">
    <a class="btn btn-primary btnn" href="{{url('finanza/')}}">Regresar</a>
    </div>




