

    <h1  class="text-center">{{$modo}} Texto</h1>
    @if(count($errors)>0)
    <div class='alert alert-danger' role='alert'>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="form-group">
        {!! Form::label('Titulo', 'Titulo') !!}
        {!! Form::text('Titulo', isset($ubicacion->Titulo)?$ubicacion->Titulo:old('Titulo'), ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo']) !!}

        @error('Titulo')
            <span class="text-danger">{{$message}}</span>
            
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('Texto', 'Texto') !!}
        {!! Form::textarea('Texto', isset($ubicacion->Texto)?$ubicacion->Texto:old('Texto'), ['class' => 'form-control', 'placeholder' => 'Ingrese el texto']) !!}

        @error('Texto')
            <span class="text-danger">{{$message}}</span>
            
        @enderror
    </div>
    {!! Form::submit('Aceptar', ['class' => 'btn btn-primary']) !!}
    <div class="d-grid col-lg mx-auto mt-2">
    <a class="btn btn-secondary" href="{{url('finanza/')}}">Regresar</a>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    

ClassicEditor
        .create( document.querySelector( '#Texto' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

