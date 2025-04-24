@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Room Images Gallery -->
            <div>
                @if(is_array($room->images) && count($room->images) > 0)
                    <div class="relative rounded-lg overflow-hidden mb-4">
                        <img src="{{ asset('storage/' . $room->images[0]) }}"
                             alt="{{ $room->name }}"
                             class="w-full h-96 object-cover">
                    </div>

                    @if(count($room->images) > 1)
                        <div class="grid grid-cols-3 gap-2">
                            @foreach(array_slice($room->images, 1, 3) as $image)
                                <div class="h-24 overflow-hidden rounded">
                                    <img src="{{ asset('storage/' . $image) }}"
                                         alt="{{ $room->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-500">No images available</span>
                    </div>
                @endif
            </div>

            <!-- Room Details -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $room->name }}</h1>

                <div class="flex items-center mt-4">
                    <div class="text-orange-600 dark:text-orange-400 text-2xl font-semibold">
                        ${{ number_format($room->price_per_night, 2) }}
                    </div>
                    <span class="text-gray-600 dark:text-gray-300 ml-1">/ night</span>
                </div>

                <!-- Room Features -->
                <div class="mt-6 grid grid-cols-2 gap-4">
                    @if($room->size)
                        <div class="flex items-center">
                            <i class="fas fa-ruler-combined text-gray-500 dark:text-gray-400 mr-2"></i>
                            <span class="text-gray-700 dark:text-gray-300">{{ $room->size }} m²</span>
                        </div>
                    @endif

                    @if($room->capacity)
                        <div class="flex items-center">
                            <i class="fas fa-user-friends text-gray-500 dark:text-gray-400 mr-2"></i>
                            <span class="text-gray-700 dark:text-gray-300">{{ $room->capacity }} guests</span>
                        </div>
                    @endif
                </div>

                <!-- Categories -->
                @if($categories->isNotEmpty())
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Categories</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($categories as $category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                {{ $category->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Locations -->
                @if($locations->isNotEmpty())
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Available at</h3>
                        <div class="space-y-2">
                            @foreach($locations as $location)
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-gray-500 dark:text-gray-400 mr-2"></i>
                                    <a href="{{ route('stays.location', $location->slug) }}" class="text-orange-600 dark:text-orange-400 hover:underline">
                                        {{ $location->name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Full Description -->
                @if(isset($room->description['full']))
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Description</h3>
                        <div class="prose dark:prose-invert max-w-none">
                            {!! $room->description['full'] !!}
                        </div>
                    </div>
                @endif

                <!-- Booking Button -->
                <div class="mt-8">
                    <button class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        Book Now
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
