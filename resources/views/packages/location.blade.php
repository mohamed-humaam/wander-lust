@extends('layouts.app')

@section('content')
    <!-- Hero Banner with Location Image -->
    <div class="relative h-64 sm:h-80 md:h-96 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/80 z-10"></div>
        @if(isset($location->images[0]))
            <img src="{{ asset('storage/' . $location->images[0]) }}"
                 alt="{{ $location->name }}"
                 class="absolute w-full h-full object-cover object-center">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-purple-600"></div>
        @endif
        <div class="container mx-auto px-4 relative z-20 h-full flex flex-col justify-end pb-8">
            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-2">{{ $location->name }}</h1>

                @if(isset($location->location['address']))
                    <div class="flex items-center text-white/90 mt-2">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $location->location['address'] }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Location Details Section -->
    <div class="bg-white dark:bg-gray-800 py-8 sm:py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="w-full lg:w-2/3">
                    <!-- Location Description -->
                    @if(isset($location->description['full']))
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">About This
                                Location</h2>
                            <div class="prose dark:prose-invert max-w-none">
                                {!! $location->description['full'] !!}
                            </div>
                        </div>
                    @endif

                    <!-- Location Gallery -->
                    @if(isset($location->gallery) && count($location->gallery) > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Gallery</h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach(array_slice($location->gallery, 0, 6) as $image)
                                    <div class="aspect-w-3 aspect-h-2 rounded-lg overflow-hidden">
                                        <img src="{{ asset('storage/' . $image) }}"
                                             alt="{{ $location->name }}"
                                             class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($location->gallery) > 6)
                                <div class="text-center mt-4">
                                    <button class="text-orange-600 dark:text-orange-400 hover:underline font-medium">
                                        View All Photos
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Available Packages Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Available
                            Packages</h2>

                        @if($packages->isEmpty())
                            <div class="text-center py-8">
                                <p class="text-gray-600 dark:text-gray-300">No packages available at this location at the
                                    moment.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($packages as $package)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden transition duration-300 hover:shadow-md">
                                        <div class="relative aspect-w-16 aspect-h-9">
                                            @if(isset($package->images[0]))
                                                <img src="{{ asset('storage/' . $package->images[0]) }}"
                                                     alt="{{ $package->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                    <span class="text-white text-lg font-medium">{{ $package->name }}</span>
                                                </div>
                                            @endif
                                            @if($package->price > 0)
                                                <div class="absolute bottom-0 right-0 bg-orange-600 text-white px-3 py-1 m-3 rounded-md font-medium">
                                                    ${{ number_format($package->price, 2) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">{{ $package->name }}</h3>

                                            <div class="flex flex-wrap gap-3 mb-3">
                                                @if($package->duration > 0)
                                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                        <i class="fas fa-calendar-alt mr-1"></i>
                                                        <span>{{ $package->duration }} days</span>
                                                    </div>
                                                @endif

                                                @if($package->category)
                                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        <span>{{ $package->category->name }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            @if(isset($package->description['short']))
                                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $package->description['short'] }}</p>
                                            @endif

                                            <a href="{{ route('packages.show', $package->id) }}"
                                               class="block text-center bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition duration-300 mt-3">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-1/3">
                    <!-- Map Section -->
                    @if(isset($location->google_location))
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Location on Map</h3>
                            <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                {!! $location->google_location !!}
                            </div>
                        </div>
                    @endif

                    <!-- Categories Section -->
                    @if($categories->isNotEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Package Categories</h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <a href="{{ route('packages.category', $category->slug) }}"
                                       class="flex items-center px-3 py-2 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                        <span class="flex-grow text-gray-800 dark:text-gray-200">{{ $category->name }}</span>
                                        <i class="fas fa-chevron-right text-gray-400"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
