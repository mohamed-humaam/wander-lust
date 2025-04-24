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

                    <!-- Available Rooms Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Available
                            Accommodations</h2>

                        @if($rooms->isEmpty())
                            <div class="text-center py-8">
                                <p class="text-gray-600 dark:text-gray-300">No rooms available at this location at the
                                    moment.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($rooms as $room)
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden transition duration-300 hover:shadow-md">
                                        <div class="relative aspect-w-16 aspect-h-9">
                                            @if(isset($room->images[0]))
                                                <img src="{{ asset('storage/' . $room->images[0]) }}"
                                                     alt="{{ $room->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                    <span class="text-white text-lg font-medium">{{ $room->name }}</span>
                                                </div>
                                            @endif
                                            @if($room->price_per_night > 0)
                                                <div class="absolute bottom-0 right-0 bg-orange-600 text-white px-3 py-1 m-3 rounded-md font-medium">
                                                    ${{ number_format($room->price_per_night, 2) }} / night
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">{{ $room->name }}</h3>

                                            <div class="flex flex-wrap gap-3 mb-3">
                                                @if($room->capacity > 0)
                                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                        <i class="fas fa-user mr-1"></i>
                                                        <span>{{ $room->capacity }} {{ $room->capacity > 1 ? 'Guests' : 'Guest' }}</span>
                                                    </div>
                                                @endif

                                                @if($room->size)
                                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                        <i class="fas fa-expand-arrows-alt mr-1"></i>
                                                        <span>{{ $room->size }} m²</span>
                                                    </div>
                                                @endif
                                            </div>

                                            @if(isset($room->description['short']))
                                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $room->description['short'] }}</p>
                                            @endif

                                            <a href="{{ route('stays.room', $room->id) }}"
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

                    <!-- Quick Booking Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Booking</h3>
                        <form id="quickBookingForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Check-in
                                    Date</label>
                                <input type="date" id="checkInDate"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white appearance-none mobile-date-input">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Check-out
                                    Date</label>
                                <input type="date" id="checkOutDate"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white appearance-none mobile-date-input">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Guests</label>
                                <select id="guestCount"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white appearance-none mobile-select">
                                    <option value="1">1 Guest</option>
                                    <option value="2">2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5+">5+ Guests</option>
                                </select>
                            </div>
                            <button type="button" id="checkAvailabilityBtn"
                                    class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-3 rounded-lg font-medium transition duration-300">
                                Check Availability
                            </button>
                        </form>
                    </div>

                    <!-- Categories Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Property Categories</h3>
                        <div class="space-y-2">
                            @php
                                // This would need to be calculated in the controller and passed to the view
                                $categories = collect($rooms)->map(function($room) {
                                    return $room->getCategories();
                                })->flatten()->unique('id');
                            @endphp

                            @foreach($categories as $category)
                                <a href="{{ route('stays.category', $category->slug) }}"
                                   class="flex items-center px-3 py-2 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                    <span class="flex-grow text-gray-800 dark:text-gray-200">{{ $category->name }}</span>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Mobile date input styles */
        @media (max-width: 767px) {
            .mobile-date-input, .mobile-select {
                font-size: 16px; /* Prevents iOS zoom on focus */
                height: 44px; /* Larger touch target */
                padding-left: 12px;
                padding-right: 12px;
                background-color: #fff;
                border-radius: 8px;
            }

            .dark .mobile-date-input, .dark .mobile-select {
                background-color: #374151;
                color: #fff;
            }

            /* Reset browser-specific styling */
            input[type="date"].mobile-date-input {
                -webkit-appearance: none;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 10px center;
                background-size: 16px;
            }

            .dark input[type="date"].mobile-date-input {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23D1D5DB' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E");
            }

            /* Hide calendar icon in Safari */
            input[type="date"].mobile-date-input::-webkit-calendar-picker-indicator {
                opacity: 0;
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                cursor: pointer;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Set the minimum date today for check-in and check-out dates
            const today = new Date().toISOString().split('T')[0];
            const checkInDateInput = document.getElementById('checkInDate');
            const checkOutDateInput = document.getElementById('checkOutDate');

            checkInDateInput.min = today;
            checkOutDateInput.min = today;

            // Default check-in date to today and check-out date to tomorrow
            checkInDateInput.value = today;

            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            checkOutDateInput.value = tomorrow.toISOString().split('T')[0];

            // When the check-in date changes, ensure the check-out date is always after check-in
            checkInDateInput.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const nextDay = new Date(selectedDate);
                nextDay.setDate(nextDay.getDate() + 1);

                const minCheckoutDate = nextDay.toISOString().split('T')[0];
                checkOutDateInput.min = minCheckoutDate;

                if (checkOutDateInput.value <= this.value) {
                    checkOutDateInput.value = minCheckoutDate;
                }
            });

            // Handle the Check Availability button click
            document.getElementById('checkAvailabilityBtn').addEventListener('click', function () {
                const locationName = "{{ $location->name }}";
                const checkInDate = document.getElementById('checkInDate').value;
                const checkOutDate = document.getElementById('checkOutDate').value;
                const guestCount = document.getElementById('guestCount').value;

                // Format dates in a more consistent cross-browser way
                function formatDate(dateStr) {
                    const date = new Date(dateStr);
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    const month = months[date.getMonth()];
                    const day = date.getDate();
                    const year = date.getFullYear();
                    return `${month} ${day}, ${year}`;
                }

                const formattedCheckIn = formatDate(checkInDate);
                const formattedCheckOut = formatDate(checkOutDate);

                // Calculate the number of nights
                const startDate = new Date(checkInDate);
                const endDate = new Date(checkOutDate);
                const nights = Math.round((endDate - startDate) / (1000 * 60 * 60 * 24));

                // Construct the WhatsApp message
                const message = `Hello! I'm interested in booking at ${locationName}.

Check-in: ${formattedCheckIn}
Check-out: ${formattedCheckOut}
Duration: ${nights} night${nights > 1 ? 's' : ''}
Guests: ${guestCount}

Please let me know about availability and rates. Thank you!`;

                // Encode the message for URL
                const encodedMessage = encodeURIComponent(message);

                // Open WhatsApp with the pre-filled message
                window.open(`https://wa.me/9607263030?text=${encodedMessage}`, '_blank');
            });
        });
    </script>
@endsection
