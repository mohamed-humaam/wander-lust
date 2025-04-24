@extends('layouts.app')

@section('content')
    <!-- Hero Banner Section for Category -->
    <div class="relative h-64 sm:h-80 md:h-96 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/80 z-10"></div>
        @if(is_array($category->images) && count($category->images) > 0)
            <img src="{{ asset('storage/' . $category->images[0]) }}"
                 alt="{{ $category->name }}"
                 class="absolute w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600"></div>
        @endif
        <div class="container mx-auto pt-32 sm:pt-24 pb-20 sm:pb-6 px-4 relative z-20 h-full flex flex-col justify-center">
            <div class="max-w-3xl bg-black/30 p-6 sm:p-8 rounded-lg backdrop-blur-sm">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-2">{{ $category->name }} Locations</h1>
                <p class="text-lg text-white/90 mb-4">Explore our curated collection of {{ strtolower($category->name) }} accommodations in breathtaking locations worldwide.</p>
                <div class="flex gap-3">
                    <a href="#locations"
                       class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition duration-300">
                        View Locations
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div id="locations" class="bg-white dark:bg-gray-800 py-10 sm:py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 sm:mb-12">
                <div class="mb-4 sm:mb-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Our {{ $category->name }} Collection</h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ $locations->total() }} stunning locations</p>
                </div>

                @if($category->children->isNotEmpty())
                    <div class="flex flex-wrap gap-2 sm:gap-3">
                        @foreach($category->children as $subcategory)
                            <a href="{{ route('stays.category', $subcategory->slug) }}"
                               class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full text-sm font-medium transition duration-300">
                                {{ $subcategory->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($locations->isEmpty())
                <div class="text-center py-12">
                    <div class="mx-auto w-24 h-24 mb-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No locations available</h3>
                    <p class="text-gray-600 dark:text-gray-300 max-w-md mx-auto">We couldn't find any locations in this category. Please check back later.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($locations as $location)
                        <x-location-card :location="$location" />
                    @endforeach
                </div>

                @if($locations->hasPages())
                    <div class="mt-12">
                        {{ $locations->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Category Description Section -->
    @if($category->description)
        <div class="bg-gray-50 dark:bg-gray-900 py-10 sm:py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">About {{ $category->name }}</h3>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! $category->description !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
