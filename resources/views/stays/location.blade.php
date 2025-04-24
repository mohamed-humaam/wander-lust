@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $location->name }}</h1>

            @if(isset($location->location['address']))
                <div class="flex items-center mt-2 text-gray-600 dark:text-gray-300">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    <span>{{ $location->location['address'] }}</span>
                </div>
            @endif

            @if(isset($location->description['full']))
                <div class="mt-4 prose dark:prose-invert max-w-none">
                    {!! $location->description['full'] !!}
                </div>
            @endif
        </div>

        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Available Rooms</h2>

        @if($rooms->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-300">No rooms available at this location.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rooms as $room)
                    <x-room-card :room="$room" />
                @endforeach
            </div>
        @endif
    </div>
@endsection
