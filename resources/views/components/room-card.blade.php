{{-- resources/views/components/room-card.blade.php --}}
@props(['room'])

<a href="{{ route('stays.room', $room->id) }}" class="group block overflow-hidden rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
    <!-- Room Image -->
    <div class="relative h-48 overflow-hidden">
        @if(is_array($room->images) && count($room->images) > 0)
            <img src="{{ asset('storage/' . $room->images[0]) }}"
                 alt="{{ $room->name }}"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No image available</span>
            </div>
        @endif
    </div>

    <!-- Room Info -->
    <div class="bg-white p-4 dark:bg-gray-800">
        <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $room->name }}</h3>
            <div class="text-right">
                <p class="text-sm font-medium text-orange-600 dark:text-orange-400">
                    ${{ number_format($room->price_per_night, 2) }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">per night</p>
            </div>
        </div>

        <!-- Room Features -->
        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-300">
            @if($room->size)
                <span class="flex items-center">
                    <i class="fas fa-ruler-combined mr-1"></i>
                    {{ $room->size }} m²
                </span>
            @endif

            @if($room->capacity)
                <span class="flex items-center">
                    <i class="fas fa-user-friends mr-1"></i>
                    {{ $room->capacity }} guests
                </span>
            @endif
        </div>

        <!-- Description excerpt -->
        @if(isset($room->description['short']))
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                {{ $room->description['short'] }}
            </p>
        @endif
    </div>
</a>
