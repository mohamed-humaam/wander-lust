@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Our Locations</h1>


        @if($locations->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-300">No locations available at the moment.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($locations as $location)
                    <x-location-card :location="$location" />
                @endforeach
            </div>
        @endif
    </div>
@endsection
