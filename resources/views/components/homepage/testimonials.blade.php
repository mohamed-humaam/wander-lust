{{-- resources/views/components/homepage/testimonials.blade.php --}}

{{-- Include Swiper CSS from CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

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
                    <button id="prev-testimonial"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-arrow-left mr-2"></i> Previous
                    </button>
                    <button id="next-testimonial"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                            <div
                                class="bg-blue-100 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "We spend some nice hours in Male while waiting for our flight. We went to
                                    to all the historic and cultural sights and were told to us about it all in an
                                    interesting
                                    way. We felt very safe and in good hands during the whole tour. Thank you for
                                    showing us your city!"
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img
                                                src="https://img.freepik.com/premium-vector/print-creative-modern-color-full-logo-design_1271730-562.jpg?semt=ais_hybrid&w=740"
                                                alt="Lene Frisenberg Mølgaard"
                                                class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Lene Frisenberg Mølgaard</h3>
                                            <div class="text-sm text-gray-500 mt-1">Google Review</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 2 --}}
                        <div class="swiper-slide">
                            <div
                                class="bg-blue-100 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "We had a long wait in the Male airport but fortunately we were recommended this
                                    travel agency by our hotel. The trip was worth every penny! Our tour guide
                                    gave us a fantastic overview of Male, told about the Maldivian culture and showed us
                                    everyday life like fish market and even some magical places. I can easily recommend
                                    this agency to everyone!"
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img
                                                src="https://img.freepik.com/premium-vector/print-creative-modern-color-full-logo-design_1271730-562.jpg?semt=ais_hybrid&w=740"
                                                alt="Michał Walczak"
                                                class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Michał Walczak</h3>
                                            <div class="text-sm text-gray-500 mt-1">Google Review</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 3 --}}
                        <div class="swiper-slide">
                            <div
                                class="bg-blue-100 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "It was an amazing trip. Our guide was really nice and took us to the most
                                    important places in Male! We loved the tour. Thank you!"
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img
                                                src="https://img.freepik.com/premium-vector/print-creative-modern-color-full-logo-design_1271730-562.jpg?semt=ais_hybrid&w=740"
                                                alt="Maria Cotter"
                                                class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Maria Cotter</h3>
                                            <div class="text-sm text-gray-500 mt-1">Google Review</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 4 --}}
                        <div class="swiper-slide">
                            <div
                                class="bg-blue-100 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "Excellent service! The team was incredibly helpful and went above and beyond to
                                    assist me with my booking. They made the whole process smooth and stress-free. I
                                    highly recommend ......."
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img
                                                src="https://img.freepik.com/premium-vector/print-creative-modern-color-full-logo-design_1271730-562.jpg?semt=ais_hybrid&w=740"
                                                alt="Hashini Perera"
                                                class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Hashini Perera</h3>
                                            <div class="text-sm text-gray-500 mt-1">Google Review</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Testimonial 5 --}}
                        <div class="swiper-slide">
                            <div
                                class="bg-blue-100 rounded-xl p-8 shadow-lg border border-gray-100 h-full transition-transform duration-300 hover:shadow-xl">
                                <div class="text-blue-600 font-medium mb-4">City Tour</div>
                                <blockquote class="text-gray-800 font-medium leading-relaxed">
                                    "One of the best Travel Agency in Maldives. Wanderlust Adventure Pvt Ltd is highly
                                    recommended for having adventurous trip through Maldives to create unforgettable
                                    happy memories that will cherish forever."
                                </blockquote>
                                <div class="pt-6 mt-6 border-t border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img
                                                src="https://img.freepik.com/premium-vector/print-creative-modern-color-full-logo-design_1271730-562.jpg?semt=ais_hybrid&w=740"
                                                alt="Hussain Nazeer"
                                                class="rounded-full w-12 h-12 object-cover border-2 border-blue-100">
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">Hussain Nazeer</h3>
                                            <div class="text-sm text-gray-500 mt-1">Google Review</div>
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
        <div class="text-center mt-10">
            <div class="text-sm text-gray-600">Trusted by the best</div>
        </div>
    </div>

    {{-- Custom styles for Swiper --}}
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

    {{-- Include Swiper JS from CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Initialize Swiper --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                // // Handling events
                // on: {
                //     init: function () {
                //         console.log('Testimonial Swiper initialized');
                //     }
                // }
            });
        });
    </script>
</section>
