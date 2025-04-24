{{-- resources/views/components/package-card.blade.php --}}
@props(['package'])

<a href="{{ route('packages.show', $package->id) }}" class="group block overflow-hidden rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
    <!-- Package Image -->
    <div class="relative h-48 overflow-hidden">
        @if(is_array($package->images) && count($package->images) > 0)
            <img src="{{ asset('storage/' . $package->images[0]) }}"
                 alt="{{ $package->name }}"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No image available</span>
            </div>
        @endif
    </div>

    <!-- Package Info -->
    <div class="bg-white p-4 dark:bg-gray-800">
        <div class="flex justify-between items-start">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $package->name }}</h3>
            <div class="text-right">
                <p class="text-sm font-medium text-orange-600 dark:text-orange-400">
                    ${{ number_format($package->price, 2) }}
                </p>
                @if($package->duration)
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $package->duration }} days</p>
                @endif
            </div>
        </div>

        <!-- Package Features -->
        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-300">
            @if($package->category)
                <span class="flex items-center">
                    <i class="fas fa-tag mr-1"></i>
                    {{ $package->category->name }}
                </span>
            @endif

            @if($package->location)
                <span class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ $package->location->name }}
                </span>
            @endif
        </div>

        <!-- Description excerpt -->
        @if(isset($package->description['short']))
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                {{ $package->description['short'] }}
            </p>
        @endif
    </div>
</a>
