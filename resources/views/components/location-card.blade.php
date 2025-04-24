{{-- resources/views/components/location-card.blade.php --}}
@props(['location'])

@php
    // Get the first category associated with this location through room links
    $category = $location->roomLinks->first()?->category;
@endphp

<a href="{{ route('stays.location', $location->slug) }}" class="group block overflow-hidden rounded-lg shadow-lg transition-all duration-300 hover:shadow-xl">
    <!-- Image Slider/Gallery -->
    <div class="relative h-64 overflow-hidden">
        @if(is_array($location->images) && count($location->images) > 0)
            <div class="relative h-full w-full">
                <!-- Main image -->
                <img src="{{ asset('storage/' . $location->images[0]) }}"
                     alt="{{ $location->name }}"
                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">

                <!-- Image count badge -->
                @if(count($location->images) > 1)
                    <div class="absolute bottom-4 right-4 bg-black bg-opacity-60 text-white px-3 py-1 rounded-full text-sm">
                        +{{ count($location->images) - 1 }} more
                    </div>
                @endif
            </div>
        @else
            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No images available</span>
            </div>
        @endif
    </div>

    <!-- Location Info -->
    <div class="bg-white p-4 dark:bg-gray-800">
        <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $location->name }}</h3>
            @if(isset($location->location['country']))
                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $location->location['country'] }}</span>
            @endif
        </div>

        <!-- Category Tag -->
        @if($category)
            <div class="mt-2">
                <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                    {{ $category->name }}
                </span>
            </div>
        @endif

        <!-- Description excerpt -->
        @if(isset($location->description['short']))
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                {{ $location->description['short'] }}
            </p>
        @endif
    </div>
</a>
