


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

    <div class="mb-3">
        <input class="form-control fs-5" type="file" name="Archivo" value="{{isset($seccione->Archivo)?$seccione->Archivo:old('Archivo')}}" id="Archivo">
    </div>

    <div class="form-group">
        {!! Form::label('Nombre', 'Nombre:') !!}
        {!! Form::text('Nombre', isset($seccione->Nombre) ? $seccione->Nombre : old('Nombre'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del archivo']) !!}
    
    
        @error('Nombre')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Titulo', 'Titulo:') !!}
        {!! Form::text('Titulo', isset($seccione->Titulo)?$seccione->Titulo:old('Titulo'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}
    
    
        @error('Titulo')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Descripcion', 'Descripcion:') !!}
        {!! Form::text('Descripcion', isset($seccione->Descripcion)?$seccione->Descripcion:old('Descripcion'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}
    
    
        @error('Descripcion')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Subtitulo', 'Subtitulo:') !!}
        {!! Form::text('Subtitulo', isset($seccione->Subtitulo)?$seccione->Subtitulo:old('Subtitulo'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}
    
    
        @error('Subtitulo')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('Texto', 'Texto:') !!}
        {!! Form::text('Texto', isset($seccione->Texto)?$seccione->Texto:old('Texto'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}
    
    
        @error('Texto')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('password', 'password:') !!}
        {!! Form::text('password', isset($seccione->password)?$seccione->password:old('Texto'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}
    
    
        @error('password')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    

    
    
    <div class="d-grid col-lg mx-auto mt-2">
    <input class="btn btn-success" type="submit" value="datos">
    </div>
    <div class="d-grid col-lg mx-auto mt-2">
    <a class="btn btn-primary btnn" href="{{url('seccione/')}}">Regresar</a>
    </div>



