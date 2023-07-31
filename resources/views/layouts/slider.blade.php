@vite(['resources/css/slide.css', 'resources/js/slider.js'])
<style>
    .slider {
        width: calc(100% * <?php echo $numImages; ?>);
        height: 475px;
        display: flex;
        margin-left: -200%;
    }
</style>
<div id="body-slider">
<div class="container-slider">
    <div class="slider" id="slider">
        @foreach($carrusels as $carrusel)
        <div class="slider__section">
            <img src="{{ url(str_replace('public/', '', 'storage/'.$carrusel->Imagen)) }}" alt="" class="slider__img">
        </div>
        @endforeach
    </div>
    <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
    <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
</div>
</div>