@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Crer nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route'=> 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}

            {{-- @include('admin.posts.partials.form') --}}

            <div class="form-group">
                {!! Form::label('name', 'Nombre:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' =>'Ingrese el nombre del post']) !!}
            
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            
            <div class="form-group">
                {!! Form::label('slug', 'slug:') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' =>'Ingrese el slug del post', 'readonly']) !!}
            
                @error('slug')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            
            <div class="form-group">
                {!! Form::label('category_id', 'categoria') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            
                @error('category_id')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <p class="font-weight-bold">Estado</p>
            
                <label>
                    {!! Form::radio('status', 1, true) !!}
                    Borrador
                </label>
            
                <label>
                    {!! Form::radio('status', 2) !!}
                    Publicado
                </label>
            
                @error('status')
                <br>
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            
            <div class="row mb-4">
                {{-- <div class="col">
                        <div class="image-wrapper">
                            @isset ($post->image)
                                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">  
                            @else
                                <img id="picture" src="https://cdn.pixabay.com/photo/2023/02/07/13/55/forest-7774205_1280.jpg" alt="">
                            @endif
                        </div>
                </div> --}}
            
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file', 'Imagen que se mostrara en la noticia') !!}
                        {!! Form::file('images[]', ['class' => 'form-control-file', 'multiple' => 'multiple', 'accept' => 'image/*', 'onchange' => 'previewImages(event)']) !!}
                    </div>
                    <div id="image-preview-container" class="image-container"></div>
            
                    @error('file')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
            
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam exercitationem nobis eligendi perspiciatis rem nam quis expedita incidunt delectus maiores soluta ipsam eaque, culpa repellat labore consequuntur error atque voluptates!</p>
                </div>
            </div>
            
            <div class="form-group">
                {!! Form::label('extract', 'Extracto:') !!}
                {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
            
                @error('extract')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            
            <div class="form-group">
                {!! Form::label('body', 'Cuerpo del la noticia:') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            
                @error('body')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            

            {!! Form::submit('Crear post', ['class' => 'btn btn-primary']) !!}
 
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }  
        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }  

        .preview-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 10px;
    }

    .preview-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    /* Estilos para el contenedor de la vista previa de imágenes */
.image-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

/* Estilos para cada imagen de vista previa */
.image-preview {
    max-width: 150px; /* Tamaño máximo de la imagen previa */
    max-height: 150px;
    margin: 10px;
    border: 1px solid #ccc; /* Borde alrededor de cada imagen previa */
    border-radius: 5px; /* Borde redondeado */
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Sombra para resaltar la imagen */
}

    </style>
@stop

@section('js')

<script src="{{asset('vendor\jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    $(document).ready( function() {
  $("#name").stringToSlug({//nombre del campo que copia 
    setEvents: 'keyup keydown blur',
    getPut: '#slug',//pegar el campo copiado
    space: '-'
  });
});

 ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } ); 

ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

        /* cambiar imagen */
        document.getElementById("file").addEventListener('change', cambiarImagen);
           function cambiarImagen(event){
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
           }
                   
</script>
    
<script>
    function previewImages(event) {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';

        if (event.target.files) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const image = document.createElement('img');
                    image.classList.add('image-preview');
                    image.src = e.target.result;
                    previewContainer.appendChild(image);
                }

                reader.readAsDataURL(file);
            }
        }
    }
</script>


@endsection