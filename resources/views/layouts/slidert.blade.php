{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
         <!-- Item 1 -->
        <div  data-carousel-item>
            <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div  data-carousel-item>
            <img src="https://cdn.pixabay.com/photo/2016/05/05/02/37/sunset-1373171_1280.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div  data-carousel-item>
            <img src="https://cdn.pixabay.com/photo/2013/10/02/23/03/mountains-190055_1280.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div  data-carousel-item>
            <img src="https://cdn.pixabay.com/photo/2017/02/01/22/02/mountain-landscape-2031539_1280.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div  data-carousel-item>
            <img src="https://cdn.pixabay.com/photo/2016/02/13/12/26/aurora-1197753_1280.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<script>
    $(document).ready(function () {
        var currentSlide = 0;
        var totalSlides = $('[data-carousel-item]').length;
        var intervalTime = 5000; // Intervalo de tiempo en milisegundos (5000ms = 5 segundos)

        function showSlide(index) {
            $('[data-carousel-item]').addClass('hidden');
            $('[data-carousel-item]').eq(index).removeClass('hidden');
            $('[data-carousel-slide-to]').attr('aria-current', 'false');
            $('[data-carousel-slide-to]').eq(index).attr('aria-current', 'true');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        function startAutoSlide() {
            intervalId = setInterval(nextSlide, intervalTime);
        }

        function stopAutoSlide() {
            clearInterval(intervalId);
        }

        $('[data-carousel-slide-to]').click(function () {
            var index = $(this).attr('data-carousel-slide-to');
            stopAutoSlide();
            showSlide(index);
            startAutoSlide();
        });

        $('[data-carousel-prev]').click(function () {
            stopAutoSlide();
            prevSlide();
            startAutoSlide();
        });

        $('[data-carousel-next]').click(function () {
            stopAutoSlide();
            nextSlide();
            startAutoSlide();
        });

        // Mostrar la primera imagen al cargar la página
        showSlide(0);

        // Iniciar el cambio automático
        startAutoSlide();
    });
</script>

