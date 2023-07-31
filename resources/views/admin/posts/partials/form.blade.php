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

<div class="row mb-4">
    <div class="col">
            <div class="image-wrapper">
                @isset ($post->image)
                    <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">  
                @else
                    <img id="picture" src="https://cdn.pixabay.com/photo/2023/02/07/13/55/forest-7774205_1280.jpg" alt="">
                @endif
            </div>
    </div>

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen que se mostrara en la noticia') !!}
            {!! Form::file('file', ['class' => 'form-control-file','accept' => 'image/*']) !!}
        </div>

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
