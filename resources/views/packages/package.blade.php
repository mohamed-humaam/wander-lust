@extends('layouts.app')

@section('content')
    <!-- Hero Banner with Package Image -->
    <div class="relative h-64 sm:h-80 md:h-96 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/80 z-10"></div>
        @if(is_array($package->images) && count($package->images) > 0)
            <img src="{{ asset('storage/' . $package->images[0]) }}"
                 alt="{{ $package->name }}"
                 class="absolute w-full h-full object-cover object-center">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-purple-600"></div>
        @endif
        <div class="container mx-auto px-4 relative z-20 h-full flex flex-col justify-end pb-8">
            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-2">{{ $package->name }}</h1>
                <div class="flex items-center text-white/90 mt-2">
                    @if($package->price > 0)
                        <div class="text-2xl font-semibold mr-4">
                            ${{ number_format($package->price, 2) }}
                        </div>
                    @endif
                    @if($package->duration > 0)
                        <div class="flex items-center mr-4">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            <span>{{ $package->duration }} days</span>
                        </div>
                    @endif
                    @if($package->location)
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>{{ $package->location->name }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Package Details Section -->
    <div class="bg-white dark:bg-gray-800 py-8 sm:py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="w-full lg:w-2/3">
                    <!-- Package Gallery -->
                    @if(is_array($package->images) && count($package->images) > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Gallery</h2>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $package->images[0]) }}"
                                         alt="{{ $package->name }}"
                                         class="w-full h-full object-cover">
                                </div>
                                @if(count($package->images) > 1)
                                    <div class="grid grid-cols-3 gap-3">
                                        @foreach(array_slice($package->images, 1, 3) as $image)
                                            <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                     alt="{{ $package->name }}"
                                                     class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Full Description -->
                    @if(isset($package->description['full']))
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Description</h2>
                            <div class="prose dark:prose-invert max-w-none">
                                {!! $package->description['full'] !!}
                            </div>
                        </div>
                    @endif

                    <!-- Included Rooms Section -->
                    @if($package->rooms->isNotEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Included Accommodations</h2>
                            <div class="space-y-4">
                                @foreach($package->rooms as $room)
                                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                        <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">{{ $room->name }}</h3>
                                        <div class="flex flex-wrap gap-3 mb-3">
                                            @if($room->capacity > 0)
                                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                    <i class="fas fa-user-friends mr-1"></i>
                                                    <span>{{ $room->capacity }} {{ $room->capacity > 1 ? 'Guests' : 'Guest' }}</span>
                                                </div>
                                            @endif
                                            @if($room->size)
                                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                                    <i class="fas fa-ruler-combined mr-1"></i>
                                                    <span>{{ $room->size }} m²</span>
                                                </div>
                                            @endif
                                        </div>
                                        @if(isset($room->description['short']))
                                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">{{ $room->description['short'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Activities Section -->
                    @if($package->activities->isNotEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Included Activities</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($package->activities as $activity)
                                    <div class="flex items-start">
                                        @if($activity->icon)
                                            <div class="flex-shrink-0 mt-1 mr-3 text-orange-500">
                                                <i class="{{ $activity->icon }} text-lg"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $activity->name }}</h3>
                                            @if(isset($activity->description['short']))
                                                <p class="text-gray-600 dark:text-gray-300 text-sm mt-1">{{ $activity->description['short'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Amenities Section -->
                    @if($package->amenities->isNotEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4">Amenities</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($package->amenities as $amenity)
                                    <div class="flex items-center">
                                        @if($amenity->icon)
                                            <i class="{{ $amenity->icon }} text-orange-500 mr-2 w-5 text-center"></i>
                                        @endif
                                        <span class="text-gray-700 dark:text-gray-300">{{ $amenity->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="w-full lg:w-1/3">
                    <!-- Package Summary -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Package Summary</h3>
                        <div class="space-y-3">
                            @if($package->category)
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Category:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $package->category->name }}</span>
                                </div>
                            @endif

                            @if($package->duration)
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Duration:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $package->duration }} days</span>
                                </div>
                            @endif

                            @if($package->price)
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Price:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">${{ number_format($package->price, 2) }}</span>
                                </div>
                            @endif

                            @if($package->location)
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Location:</span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $package->location->name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Booking Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Book This Package</h3>
                        <form id="quickBookingForm">
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Start Date</label>
                                <input type="date" id="startDate"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white appearance-none mobile-date-input">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Guests</label>
                                <select id="guestCount"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-gray-700 dark:text-white appearance-none mobile-select">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}</option>
                                    @endfor
                                    <option value="10+">10+ Guests</option>
                                </select>
                            </div>

                            <button type="button" id="bookNowBtn"
                                    class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-3 rounded-lg font-medium transition duration-300">
                                Book Now
                            </button>
                        </form>
                    </div>

                    <!-- Location Info -->
                    @if($package->location)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Location Information</h3>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-16 w-16 rounded-lg overflow-hidden mr-3">
                                        @if(is_array($package->location->images) && count($package->location->images) > 0)
                                            <img src="{{ asset('storage/' . $package->location->images[0]) }}"
                                                 alt="{{ $package->location->name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                                <i class="fas fa-map-marker-alt text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">{{ $package->location->name }}</h4>
                                        @if(isset($package->location->location['address']))
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                                <i class="fas fa-map-marker-alt text-xs mr-1"></i>
                                                {{ $package->location->location['address'] }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                @if($package->location->google_location)
                                    <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden mt-3">
                                        {!! $package->location->google_location !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
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
            // Set the minimum date today for start date
            const today = new Date().toISOString().split('T')[0];
            const startDateInput = document.getElementById('startDate');

            startDateInput.min = today;
            startDateInput.value = today;

            // Handle the Book Now button click
            document.getElementById('bookNowBtn').addEventListener('click', function () {
                const packageName = "{{ $package->name }}";
                const startDate = document.getElementById('startDate').value;
                const guestCount = document.getElementById('guestCount').value;

                // Format date in a more consistent cross-browser way
                function formatDate(dateStr) {
                    const date = new Date(dateStr);
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    const month = months[date.getMonth()];
                    const day = date.getDate();
                    const year = date.getFullYear();
                    return `${month} ${day}, ${year}`;
                }

                const formattedStartDate = formatDate(startDate);

                // Construct the WhatsApp message
                const message = `Hello! I'm interested in booking the ${packageName} package.

Start Date: ${formattedStartDate}
Guests: ${guestCount}
Total Price: ${{ number_format($package->price, 2) }}

                Please let me know about availability. Thank you!`;

                // Encode the message for URL
                const encodedMessage = encodeURIComponent(message);

                // Open WhatsApp with the pre-filled message
                window.open(`https://wa.me/9607263030?text=${encodedMessage}`, '_blank');
            });
        });
    </script>
@endsection
