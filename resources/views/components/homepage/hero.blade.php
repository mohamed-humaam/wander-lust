<div class="relative w-full h-screen min-h-[600px] max-h-[800px] overflow-hidden text-white m-0 p-0">
    <!-- Background Image Carousel -->
    <div class="hero-background absolute top-0 left-0 w-full h-full">
        @php
            $images = [
                '/assets/images/images/hero/banner-1.jpg',
                '/assets/images/images/hero/banner-2.jpg',
                '/assets/images/images/hero/banner-3.jpg',
                '/assets/images/images/hero/banner-4.jpg',
                '/assets/images/images/hero/banner-5.jpg',
                '/assets/images/images/hero/banner-6.jpg',
                '/assets/images/images/hero/banner-7.jpg',
                '/assets/images/images/hero/banner-8.jpg',
                '/assets/images/images/hero/banner-9.jpg',
                '/assets/images/images/hero/banner-10.jpg',
            ];
        @endphp

        @foreach($images as $index => $image)
            <div
                class="hero-image absolute top-0 left-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 ease-in-out z-10 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                data-index="{{ $index }}"
                style="background-image: url('{{ $image }}')">
                @if($index === 0)
                    <div class="absolute top-0 left-0 w-full h-full bg-[rgba(0,105,148,0.3)] z-20"></div>
                @endif
            </div>
        @endforeach

        <!-- Image Controls -->
        <div
            class="image-controls absolute bottom-5 left-1/2 transform -translate-x-1/2 flex items-center gap-2.5 z-30">
            <button
                class="control-btn prev-btn bg-white/30 border-none text-white w-10 h-10 rounded-full text-base cursor-pointer flex items-center justify-center transition-colors duration-300 hover:bg-white/50">
                ❮
            </button>
            <div class="image-indicators flex gap-2">
                @foreach($images as $index => $image)
                    <span
                        class="w-3 h-3 rounded-full cursor-pointer transition-colors duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"
                        data-index="{{ $index }}"
                    ></span>
                @endforeach
            </div>
            <button
                class="control-btn next-btn bg-white/30 border-none text-white w-10 h-10 rounded-full text-base cursor-pointer flex items-center justify-center transition-colors duration-300 hover:bg-white/50">
                ❯
            </button>
        </div>
    </div>

    <!-- Hero Content -->
    <div
        class="hero-content relative z-20 flex flex-col justify-center items-center h-full p-5 text-center bg-black/40">
        <!-- Include Search Form Component -->
        @include('components.homepage.search-form')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentImage = 0;
        const images = document.querySelectorAll('.hero-image');
        const indicators = document.querySelectorAll('.image-indicators span');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        let interval;

        // Initialize carousel
        startCarousel();

        // Set up event listeners
        prevBtn.addEventListener('click', prevImage);
        nextBtn.addEventListener('click', nextImage);

        indicators.forEach(indicator => {
            indicator.addEventListener('click', function () {
                const index = parseInt(this.getAttribute('data-index'));
                setImage(index);
            });
        });

        function startCarousel() {
            interval = setInterval(() => {
                nextImage();
            }, 5000);
        }

        function nextImage() {
            currentImage = (currentImage + 1) % images.length;
            updateActiveImage();
        }

        function prevImage() {
            currentImage = (currentImage - 1 + images.length) % images.length;
            updateActiveImage();
        }

        function setImage(index) {
            currentImage = index;
            updateActiveImage();
            // Reset the interval when manually changing image
            clearInterval(interval);
            startCarousel();
        }

        function updateActiveImage() {
            // Update active image
            images.forEach((image, index) => {
                if (index === currentImage) {
                    image.classList.remove('opacity-0');
                    image.classList.add('opacity-100');
                    // Add the blue overlay if it doesn't exist
                    if (!image.querySelector('.bg-\\[rgba\\(0\\,105\\,148\\,0\\.3\\)\\]')) {
                        const overlay = document.createElement('div');
                        overlay.className = 'absolute top-0 left-0 w-full h-full bg-[rgba(0,105,148,0.3)] z-20';
                        image.appendChild(overlay);
                    }
                } else {
                    image.classList.remove('opacity-100');
                    image.classList.add('opacity-0');
                    // Remove the blue overlay if it exists
                    const overlay = image.querySelector('.bg-\\[rgba\\(0\\,105\\,148\\,0\\.3\\)\\]');
                    if (overlay) {
                        image.removeChild(overlay);
                    }
                }
            });

            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentImage) {
                    indicator.classList.remove('bg-white/50');
                    indicator.classList.add('bg-white');
                } else {
                    indicator.classList.remove('bg-white');
                    indicator.classList.add('bg-white/50');
                }
            });
        }
    });
</script>
