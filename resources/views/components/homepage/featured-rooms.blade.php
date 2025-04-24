@props(['rooms' => [], 'limit' => 3])

<div class="py-8 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Featured Accommodations</h2>
            <a href="{{ route('stays.index') }}" class="rounded bg-orange-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-orange-700 dark:bg-orange-500 dark:hover:bg-orange-600">
                Explore More
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-{{ min($limit, 3) }}">
            @forelse($rooms->take($limit) as $room)
                <x-stays.room-card :room="$room" />
            @empty
                <div class="col-span-full rounded-lg bg-white p-8 text-center dark:bg-gray-800">
                    <p class="text-gray-600 dark:text-gray-300">No featured rooms available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
