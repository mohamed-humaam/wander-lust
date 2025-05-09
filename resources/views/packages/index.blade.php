@extends('layouts.app')

@section('content')
    <!-- Hero Banner Section -->
    <div class="relative h-[32rem] sm:h-112 md:h-128 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/80 z-10"></div>
        <img
            src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80"
            alt="Luxury Packages"
            class="absolute w-full h-full object-cover object-center">
        <div class="container mx-auto pt-32 sm:pt-24 pb-20 sm:pb-6 px-4 relative z-20 h-full flex flex-col justify-center">
            <div
                class="mt-8 mb-8 max-w-2xl bg-black/30 p-4 sm:p-6 md:p-8 rounded-lg backdrop-blur-sm">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-2 md:mb-4">Discover Our Exclusive Packages</h1>
                <p class="text-lg sm:text-xl text-white mb-4 md:mb-8">Experience curated getaways with our premium accommodation and activity bundles.</p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="#featured"
                       class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 text-center">
                        Explore Packages
                    </a>
                    <a href="#"
                       class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg font-medium transition duration-300 backdrop-blur-sm text-center">
                        Special Offers
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories Section -->
    <div class="bg-gray-50 dark:bg-gray-900 py-8 sm:py-12">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">Browse By Category</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Find the perfect package for your travel style</p>
            </div>

            <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                @php
                    $categories = App\Models\Category::whereNull('parent_id')
                        ->withCount(['packages'])
                        ->take(8)
                        ->get();
                @endphp

                @foreach($categories as $category)
                    <a href="{{ route('packages.category', $category->slug) }}"
                       class="group relative overflow-hidden rounded-lg h-32 sm:h-40 hover:shadow-lg transition duration-300">
                        @if(is_array($category->images) && count($category->images) > 0)
                            <img src="{{ asset('storage/' . $category->images[0]) }}"
                                 alt="{{ $category->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div
                                class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-base sm:text-lg font-medium">{{ $category->name }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition duration-300"></div>
                        <div class="absolute bottom-0 left-0 p-3 sm:p-4">
                            <h3 class="text-white font-semibold text-base sm:text-lg">{{ $category->name }}</h3>
                            <p class="text-white/90 text-xs sm:text-sm">{{ $category->packages_count }} packages</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Packages Section -->
    <div id="featured" class="py-10 sm:py-16 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 sm:mb-8">
                <div class="mb-4 sm:mb-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Featured Packages</h2>
                    <p class="text-gray-600 dark:text-gray-300">Our most popular curated experiences</p>
                </div>
            </div>

            @if($packages->isEmpty())
                <div class="text-center py-8 sm:py-12">
                    <p class="text-gray-600 dark:text-gray-300">No packages available at the moment.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($packages->take(6) as $package)
                        <x-packages.package-card :package="$package"/>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="bg-gray-50 dark:bg-gray-900 py-10 sm:py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">What Our Guests Say</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Don't just take our word for it - hear from our satisfied guests</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 font-bold mr-3 sm:mr-4">
                            JD
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">John Doe</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base">"The package was absolutely stunning with everything included. The service was impeccable and we'll definitely book again!"</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 font-bold mr-3 sm:mr-4">
                            AS
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Alice Smith</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base">"Perfect package with everything we needed. The activities were well planned and the accommodation was excellent."</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center text-orange-600 dark:text-orange-300 font-bold mr-3 sm:mr-4">
                            RJ
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Robert Johnson</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base">"From booking to checkout, everything was seamless. The package included all the amenities we needed and more."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 py-10 sm:py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3 sm:mb-4">Ready for Your Next Adventure?</h2>
            <p class="text-white/90 mb-6 sm:mb-8 max-w-2xl mx-auto">Sign up for exclusive package deals and early access to our newest offerings</p>
            <form class="max-w-md mx-auto">
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-0">
                    <input type="email" placeholder="Your email address"
                           class="w-full sm:flex-grow px-4 py-3 rounded-lg sm:rounded-r-none focus:outline-none">
                    <button
                        class="w-full sm:w-auto bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg sm:rounded-l-none font-medium transition duration-300">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
