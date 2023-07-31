@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
    <h1>Editar post</h1>
@stop

@section('content')
{{-- alertas --}}
@if (session('info'))
<div class="alert alert-success">
    <strong>{{session('info')}}</strong>

</div>
@endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($post,['route'=> ['admin.posts.update',$post], 'autocomplete' => 'off', 'files' => true,'method'=>'put']) !!}

                
            {{--  @include('admin.posts.partials.form') --}}

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
            
            {{-- <div class="form-group">
                <p class="font-weight-bold">Etiquetas</p>
                @foreach ($tags as $tag)
                    <label class="mr-2">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{$tag->name}}
                    </label>
                    
                @endforeach
            
                
            
                @error('tags')
                <br>
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div> --}}
            
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
                        {!! Form::label('file', 'Imagen que se mostrará en la noticia') !!}
                        {!! Form::file('images[]', ['class' => 'form-control-file', 'multiple' => 'multiple', 'accept' => 'image/*']) !!}
                    </div>
                
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                
                    
                </div>
                
                
                    <div class="form-group">
                        {!! Form::label('uploaded_images', 'Imágenes pertenecientes a este post:') !!}
                        <div>
                            @if (isset($post->images) && $post->images->count() > 0)
                                @foreach ($post->images as $image)
                                    <div>
                                        <img src="{{ asset('storage/' . $image->url) }}" height="70px" width="70px" alt="Post Image"> 
                                        <form action="{{ route('admin.images.destroy', $image->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            {!! Form::submit('Actualizar post', ['class' => 'btn btn-warning']) !!}
                                        </form>
                                    </div>
                                @endforeach
                            @endif
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

            {!! Form::submit('Actualizar post', ['class' => 'btn btn-primary']) !!}
 
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('css')
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

        
</script>
    
@endsection