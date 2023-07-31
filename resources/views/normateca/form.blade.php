


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

    <div class="form-floating mb-2">
        <select class="form-select" name="opcion" id="opcion">
            <option value="SECRETARIA GENERAL DEL SNTI">SECRETARIA GENERAL DEL SNTI</option>
            <option value="REGLAMENTOS">REGLAMENTOS</option>
            <option value="INFORMACIÓN JURISPRUDENCIA">INFORMACIÓN JURISPRUDENCIA</option>
        </select>
        <label for="opcion">Seleccionar opción</label>
    </div>

    <div class="mb-3">
        <input class="form-control fs-5" type="file" name="Archivo" value="{{isset($normateca->Archivo)?$normateca->Archivo:old('Archivo')}}" id="Archivo">
    </div>

    <div class="form-group">
        {!! Form::label('Nombre', 'Nombre:') !!}
        {!! Form::text('Nombre', isset($normateca->Nombre) ? $normateca->Nombre : old('Nombre'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del archivo']) !!}
    
    
        @error('Nombre')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Descripcion', 'Descripcion:') !!}
        {!! Form::text('Descripcion', isset($normateca->Descripcion) ? $normateca->Descripcion : old('Descripcion'), ['class' => 'form-control', 'placeholder' => 'Ingrese la descripcion']) !!}
    
    
        @error('Descripcion')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('password', 'password:') !!}
        {!! Form::text('password', isset($normateca->password) ? $normateca->password : old('password'), ['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña']) !!}
    
    
        @error('password')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    
    <div class="d-grid col-lg mx-auto mt-2">
    <input class="btn btn-success" type="submit" value="datos">
    </div>
    <div class="d-grid col-lg mx-auto mt-2">
    <a class="btn btn-primary btnn" href="{{url('normateca/')}}">Regresar</a>
    </div>

