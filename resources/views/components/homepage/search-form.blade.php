@php
    use App\Models\Location;
    $locations = Location::all();
@endphp

<div class="bg-white rounded-xl shadow-xl p-6 md:p-8 max-w-5xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 tracking-tight">Find Your Perfect Stay</h2>
        <p class="text-gray-600 mt-3 text-lg">Discover luxury accommodations tailored for you</p>
    </div>

    <form action="/packages/search" method="GET" class="space-y-8">
        <!-- Search Container with Gradient Border -->
        <div class="p-0.5 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500">
            <div class="bg-white rounded-lg p-5 md:p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Location Autocomplete -->
                <div class="col-span-1 md:col-span-1 relative">
                    <label for="location-search" class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="location-search" placeholder="Where to?" class="block w-full rounded-lg border-gray-300 pl-10 pr-4 py-3 shadow-sm focus:ring-amber-500 focus:border-amber-500 bg-white text-gray-900">
                        <input type="hidden" name="location" id="location-id">

                        <!-- Autocomplete Suggestions -->
                        <div id="location-suggestions" class="absolute z-10 w-full mt-1 bg-white shadow-lg rounded-md border border-gray-200 hidden max-h-60 overflow-y-auto">
                            <!-- Suggestions will be populated here -->
                        </div>
                    </div>
                </div>

                <!-- Check-in Date -->
                <div class="col-span-1">
                    <label for="checkin" class="block text-sm font-medium text-gray-700 mb-2">Check-in</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="date" id="checkin" name="checkin" min="{{ date('Y-m-d') }}" class="block w-full rounded-lg border-gray-300 pl-10 pr-4 py-3 shadow-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>

                <!-- Check-out Date -->
                <div class="col-span-1">
                    <label for="checkout" class="block text-sm font-medium text-gray-700 mb-2">Check-out</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="date" id="checkout" name="checkout" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="block w-full rounded-lg border-gray-300 pl-10 pr-4 py-3 shadow-sm focus:ring-amber-500 focus:border-amber-500">
                    </div>
                </div>

                <!-- Passengers -->
                <div class="col-span-1 md:col-span-1 relative">
                    <label for="passengers" class="block text-sm font-medium text-gray-700 mb-2">Guests</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <button type="button" id="passengers" class="flex justify-between items-center w-full rounded-lg border border-gray-300 shadow-sm pl-10 pr-4 py-3 bg-white text-left focus:outline-none focus:ring-amber-500 focus:border-amber-500">
                            <span id="guests-display">0 Adults, 0 Children</span>
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown for passengers selection -->
                        <div id="passengers-dropdown" class="hidden absolute right-0 mt-2 w-full bg-white border border-gray-200 rounded-lg shadow-lg z-10 p-4">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-sm font-medium text-gray-700">Adults</span>
                                <div class="flex items-center">
                                    <button type="button" class="decrement-adults w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                        <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <input type="number" name="adults" id="adults" value="0" min="1" max="10" class="w-12 mx-2 text-center border border-gray-300 rounded py-1">
                                    <button type="button" class="increment-adults w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                        <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Children</span>
                                <div class="flex items-center">
                                    <button type="button" class="decrement-children w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                        <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <input type="number" name="children" id="children" value="0" min="0" max="10" class="w-12 mx-2 text-center border border-gray-300 rounded py-1">
                                    <button type="button" class="increment-children w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                        <svg class="h-4 w-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Button -->
        <div class="flex justify-center">
            <button type="submit" class="inline-flex justify-center items-center py-3 px-10 border border-transparent shadow-md text-base font-medium rounded-lg text-white bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
                Search Packages
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load locations from PHP into JavaScript
        const locations = @json($locations);

        // Location autocomplete functionality
        const locationSearchInput = document.getElementById('location-search');
        const locationIdInput = document.getElementById('location-id');
        const locationSuggestions = document.getElementById('location-suggestions');

        // Filter locations based on input
        locationSearchInput.addEventListener('input', function() {
            const inputValue = this.value.toLowerCase();

            // Clear suggestions
            locationSuggestions.innerHTML = '';

            // Hide suggestions if input is empty
            if (inputValue.length === 0) {
                locationSuggestions.classList.add('hidden');
                return;
            }

            // Filter locations based on input
            const filteredLocations = locations.filter(location =>
                location.name.toLowerCase().includes(inputValue)
            );

            // Show suggestions
            if (filteredLocations.length > 0) {
                locationSuggestions.classList.remove('hidden');

                // Add suggestions to dropdown
                filteredLocations.forEach(location => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.className = 'flex items-center px-4 py-3 hover:bg-amber-50 cursor-pointer border-b border-gray-100 last:border-0';

                    // Add location icon
                    const iconSpan = document.createElement('span');
                    iconSpan.className = 'mr-3 text-amber-500';
                    iconSpan.innerHTML = `
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    `;

                    const textSpan = document.createElement('span');
                    textSpan.textContent = location.name;

                    suggestionItem.appendChild(iconSpan);
                    suggestionItem.appendChild(textSpan);

                    // Select a suggestion
                    suggestionItem.addEventListener('click', function() {
                        locationSearchInput.value = location.name;
                        locationIdInput.value = location.id;
                        locationSuggestions.classList.add('hidden');
                    });

                    locationSuggestions.appendChild(suggestionItem);
                });
            } else {
                // Show "No results" message
                locationSuggestions.classList.remove('hidden');
                const noResults = document.createElement('div');
                noResults.className = 'px-4 py-3 text-gray-500 text-center';
                noResults.textContent = 'No locations found';
                locationSuggestions.appendChild(noResults);
            }
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(event) {
            if (!locationSearchInput.contains(event.target) && !locationSuggestions.contains(event.target)) {
                locationSuggestions.classList.add('hidden');
            }
        });

        // Passengers functionality
        const passengersBtn = document.getElementById('passengers');
        const passengersDropdown = document.getElementById('passengers-dropdown');
        const adultsInput = document.getElementById('adults');
        const childrenInput = document.getElementById('children');
        const guestsDisplay = document.getElementById('guests-display');
        const checkinInput = document.getElementById('checkin');
        const checkoutInput = document.getElementById('checkout');

        // Set default values
        adultsInput.value = 1;
        childrenInput.value = 0;
        updateGuestsDisplay();

        // Set minimum dates for check-in and checkout
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        checkinInput.min = today.toISOString().split('T')[0];
        checkoutInput.min = tomorrow.toISOString().split('T')[0];

        // Toggle passengers dropdown
        passengersBtn.addEventListener('click', function() {
            passengersDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!passengersBtn.contains(event.target) && !passengersDropdown.contains(event.target)) {
                passengersDropdown.classList.add('hidden');
            }
        });

        // Increment and decrement buttons
        document.querySelector('.increment-adults').addEventListener('click', function() {
            if (parseInt(adultsInput.value) < 10) {
                adultsInput.value = parseInt(adultsInput.value) + 1;
                updateGuestsDisplay();
            }
        });

        document.querySelector('.decrement-adults').addEventListener('click', function() {
            if (parseInt(adultsInput.value) > 1) {
                adultsInput.value = parseInt(adultsInput.value) - 1;
                updateGuestsDisplay();
            }
        });

        document.querySelector('.increment-children').addEventListener('click', function() {
            if (parseInt(childrenInput.value) < 10) {
                childrenInput.value = parseInt(childrenInput.value) + 1;
                updateGuestsDisplay();
            }
        });

        document.querySelector('.decrement-children').addEventListener('click', function() {
            if (parseInt(childrenInput.value) > 0) {
                childrenInput.value = parseInt(childrenInput.value) - 1;
                updateGuestsDisplay();
            }
        });

        // Update check-out date when check-in date changes
        checkinInput.addEventListener('change', function() {
            const checkinDate = new Date(this.value);
            const nextDay = new Date(checkinDate);
            nextDay.setDate(nextDay.getDate() + 1);

            checkoutInput.min = nextDay.toISOString().split('T')[0];

            // If current checkout date is before new minimum, update it
            if (new Date(checkoutInput.value) <= checkinDate) {
                checkoutInput.value = nextDay.toISOString().split('T')[0];
            }
        });

        // Function to update guests display
        function updateGuestsDisplay() {
            const adults = parseInt(adultsInput.value);
            const children = parseInt(childrenInput.value);
            const adultText = adults === 1 ? '1 Adult' : `${adults} Adults`;
            const childText = children === 0 ? '0 Children' : children === 1 ? '1 Child' : `${children} Children`;
            guestsDisplay.textContent = `${adultText}, ${childText}`;
        }

        // Initialize with default values
        updateGuestsDisplay();
    });
</script>
