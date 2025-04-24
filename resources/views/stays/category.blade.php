@extends('layouts.app')

@section('content')
    <!-- Hero Banner Section - Enhanced with Parallax Effect -->
    <div class="relative h-[70vh] min-h-[500px] overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/30 to-transparent z-10"></div>
        @if(is_array($category->images) && count($category->images) > 0)
            <img src="{{ asset('storage/' . $category->images[0]) }}"
                 alt="{{ $category->name }}"
                 class="absolute w-full h-full object-cover object-center transition-all duration-700 ease-out transform hover:scale-105">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-purple-700"></div>
        @endif
        <div class="container mx-auto pt-32 sm:pt-24 pb-20 sm:pb-6 px-4 relative z-20 h-full flex flex-col justify-end">
            <div class="max-w-4xl bg-white/10 backdrop-blur-sm rounded-2xl p-8 sm:p-10 border border-white/20 shadow-xl">
                <div class="flex items-center mb-4">
                    <span class="bg-orange-500 text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $category->locations_count }} Locations</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    {{ $category->name }}<br>Experiences
                </h1>
                <p class="text-lg text-white/90 mb-6 max-w-2xl">Discover our curated collection of premium {{ strtolower($category->name) }} accommodations in breathtaking locations worldwide.</p>
                <div class="flex flex-wrap gap-3">
                    <a href="#locations"
                       class="flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        Explore Locations
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    @if($category->description)
                        <a href="#category-details"
                           class="flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-lg font-medium transition-all duration-300 backdrop-blur-sm">
                            Learn More
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section - Enhanced Card Grid -->
    <div id="locations" class="bg-white dark:bg-gray-900 py-16 sm:py-24">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-12">
                <div class="mb-6 lg:mb-0">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">Our {{ $category->name }} Collection</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $locations->total() }} carefully selected properties</p>
                </div>

                @if($category->children->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach($category->children as $subcategory)
                            <a href="{{ route('stays.category', $subcategory->slug) }}"
                               class="px-4 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-sm font-medium transition-all duration-300 flex items-center">
                                {{ $subcategory->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($locations->isEmpty())
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 mb-6 text-gray-300 dark:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-3">No locations available</h3>
                    <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto">We're currently updating our collection. Please check back soon for amazing {{ strtolower($category->name) }} options.</p>
                    <a href="{{ route('stays.index') }}" class="mt-6 inline-flex items-center text-orange-600 dark:text-orange-500 hover:underline font-medium">
                        Browse all stays
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($locations as $location)
                        <x-location-card :location="$location" />
                    @endforeach
                </div>

                @if($locations->hasPages())
                    <div class="mt-16 flex justify-center">
                        {{ $locations->onEachSide(1)->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Category Description Section - Premium Experience -->
    @if($category->description)
        <div id="category-details" class="bg-gray-50 dark:bg-gray-900/50 py-16 sm:py-24">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="max-w-7xl mx-auto">
                    <div class="relative bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-2xl">
                        @if(is_array($category->images) && count($category->images) > 1)
                            <div class="relative h-64 sm:h-96 w-full">
                                <img src="{{ asset('storage/' . $category->images[1]) }}"
                                     alt="{{ $category->name }} overview"
                                     class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent"></div>
                            </div>
                        @endif

                        <div class="p-8 sm:p-12 md:p-16">
                            <div class="max-w-4xl mx-auto">
                                <div class="mb-10 text-center">
                                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">The {{ $category->name }} Experience</h2>
                                    <div class="w-20 h-1 bg-orange-500 mx-auto rounded-full"></div>
                                </div>

                                <div class="prose dark:prose-invert max-w-none lg:prose-lg">
                                    {!! $category->description !!}
                                </div>

                                <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <!-- Feature 1 -->
                                    <div class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                                        <div class="absolute -top-5 left-6 w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center text-white transform group-hover:-translate-y-2 transition-all duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-8 text-xl font-semibold text-gray-900 dark:text-white">Premium Comfort</h3>
                                        <p class="mt-4 text-gray-600 dark:text-gray-400">Experience unparalleled comfort with our carefully selected accommodations featuring premium amenities and thoughtful design.</p>
                                    </div>

                                    <!-- Feature 2 -->
                                    <div class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                                        <div class="absolute -top-5 left-6 w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center text-white transform group-hover:-translate-y-2 transition-all duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-8 text-xl font-semibold text-gray-900 dark:text-white">Prime Locations</h3>
                                        <p class="mt-4 text-gray-600 dark:text-gray-400">Our properties are strategically located to provide easy access to key attractions and business districts.</p>
                                    </div>

                                    <!-- Feature 3 -->
                                    <div class="group relative bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
                                        <div class="absolute -top-5 left-6 w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center text-white transform group-hover:-translate-y-2 transition-all duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-8 text-xl font-semibold text-gray-900 dark:text-white">Trusted Quality</h3>
                                        <p class="mt-4 text-gray-600 dark:text-gray-400">Every property undergoes rigorous vetting to ensure they meet our high standards of quality and service.</p>
                                    </div>
                                </div>

                                <div class="mt-16 text-center">
                                    <a href="#locations" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-orange-600 hover:bg-orange-700 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                        Explore {{ $category->name }} Stays
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
