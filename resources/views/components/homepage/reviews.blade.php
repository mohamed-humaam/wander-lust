{{-- Testimonial Section --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            {{-- Testimonial Header Section --}}
            <div class="lg:col-span-5">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight">
                    What our customers are<br> saying about us?
                </h2>
                <p class="text-gray-600 mt-5">More than 200 google reviews.</p>

                <div class="grid grid-cols-2 gap-8 mt-12">
                    <div>
                        <div class="text-3xl font-bold leading-tight text-blue-600">40k+</div>
                        <div class="text-gray-700">Happy People</div>
                    </div>

                    <div>
                        <div class="text-3xl font-bold leading-tight text-blue-600">5.00</div>
                        <div class="text-gray-700">Overall rating</div>

                        <div class="flex space-x-1 mt-2">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="flex items-center mt-12 space-x-4">
                    <button id="prev-testimonial" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-arrow-left mr-2"></i> Previous
                    </button>
                    <button id="next-testimonial" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Next <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            {{-- Testimonials Swiper Section --}}
            <div class="lg:col-span-7">
                <div id="testimonials-swiper" class="swiper-container overflow-hidden h-full">
                    <div class="swiper-wrapper">
                        {{-- Testimonial 1 --}}
                        <div class="swiper-slide">
                            <div class="bg-gray-50 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "We spend some nice hours in Male with Muez while waiting for our flight. He took us to all the historic and cultural sights and told us about it all in an interesting way. We felt very safe and in good hands during the whole tour. Thank you for showing us your city!"
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/testimonials/user1.jpg') }}" alt="Lene Frisenberg Mølgaard" class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Lene Frisenberg Mølgaard</h3>
                                            <div class="text-sm text-gray-500 mt-1">
                                                <span class="flex items-center">
                                                    <img src="{{ asset('images/google-logo.png') }}" alt="Google" class="h-4 w-4 mr-1">
                                                    Google Review
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 2 --}}
                        <div class="swiper-slide">
                            <div class="bg-gray-50 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "We had a long wait in the Male airport but fortunately we were recommended this travel agency by our hotel. The trip was worth every penny! Sadiq, our tour guide gave us a fantastic overview of Male, told about the Maldivian culture and showed us everyday life like fish market and even some magical places. I can easily recommend this agency to everyone!"
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/testimonials/user2.jpg') }}" alt="Michał Walczak" class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Michał Walczak</h3>
                                            <div class="text-sm text-gray-500 mt-1">
                                                <span class="flex items-center">
                                                    <img src="{{ asset('images/google-logo.png') }}" alt="Google" class="h-4 w-4 mr-1">
                                                    Google Review
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 3 --}}
                        <div class="swiper-slide">
                            <div class="bg-gray-50 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "It was an amazing trip. Our guide was really nice and took us to the most importante places in Male! We loved the tour. Thank you Naseem!"
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('images/testimonials/user3.jpg') }}" alt="Maria Cotter" class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Maria Cotter</h3>
                                            <div class="text-sm text-gray-500 mt-1">
                                                <span class="flex items-center">
                                                    <img src="{{ asset('images/google-logo.png') }}" alt="Google" class="h-4 w-4 mr-1">
                                                    Google Review
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Text --}}
        <div class="text-center mt-16">
            <div class="text-sm text-gray-600">Trusted by the best</div>

            {{-- Brand Logos Could Go Here --}}
            <div class="flex justify-center items-center space-x-8 mt-6">
                {{-- Add your partner logos here --}}
            </div>
        </div>
    </div>

    {{-- Make sure to include Swiper CSS in your layout or here --}}
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <style>
            .swiper-container {
                width: 100%;
                padding-top: 20px;
                padding-bottom: 40px;
            }

            .swiper-slide {
                opacity: 0.4;
                transform: scale(0.85);
                transition: all 0.3s ease;
            }

            .swiper-slide-active {
                opacity: 1;
                transform: scale(1);
            }

            /* Add grab cursor for better UX */
            .swiper-container {
                cursor: grab;
            }

            .swiper-container:active {
                cursor: grabbing;
            }
        </style>
    @endpush

    {{-- Make sure to include Swiper JS and initialization in your scripts section --}}
    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const testimonialSwiper = new Swiper('#testimonials-swiper', {
                    // Enable mouse/touch dragging and throw effect
                    grabCursor: true,
                    effect: 'cards',
                    cardsEffect: {
                        slideShadows: false,
                    },
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    speed: 800,
                    // Enable mousewheel control
                    mousewheel: {
                        invert: false,
                    },
                    // Add responsive breakpoints
                    breakpoints: {
                        640: {
                            slidesPerView: 1,
                        },
                        768: {
                            slidesPerView: 1.2,
                        },
                        1024: {
                            slidesPerView: 1.5,
                        },
                    },
                    // Add navigation buttons
                    navigation: {
                        nextEl: '#next-testimonial',
                        prevEl: '#prev-testimonial',
                    },
                    // Enable keyboard control
                    keyboard: {
                        enabled: true,
                    },
                    // Free mode for throw effect
                    freeMode: {
                        enabled: true,
                        sticky: true,
                        momentum: true,
                        momentumRatio: 0.8,
                        momentumBounce: true,
                        momentumBounceRatio: 1,
                    },
                    // Handling events
                    on: {
                        init: function() {
                            console.log('Testimonial Swiper initialized');
                        }
                    }
                });
            });
        </script>
    @endpush
</section>
