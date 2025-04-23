<!--airline-carousel.blade.php-->
@php
    $airlineLogos = [
        [ 'path' => 'assets/images/airlines/air-asia.svg', 'name' => 'Air Asia' ],
        [ 'path' => 'assets/images/airlines/bangkok.svg', 'name' => 'Bangkok Airways' ],
        [ 'path' => 'assets/images/airlines/batik.svg', 'name' => 'Batik Air' ],
        [ 'path' => 'assets/images/airlines/emirates.svg', 'name' => 'Emirates' ],
        [ 'path' => 'assets/images/airlines/air-arabia.svg', 'name' => 'Air Arabia' ],
        [ 'path' => 'assets/images/airlines/azerbaijan.svg', 'name' => 'Azerbaijan Airlines' ],
        [ 'path' => 'assets/images/airlines/ethihad.svg', 'name' => 'Etihad Airways' ],
        [ 'path' => 'assets/images/airlines/flydubai.svg', 'name' => 'Flydubai' ],
        [ 'path' => 'assets/images/airlines/indigo.svg', 'name' => 'IndiGo' ],
        [ 'path' => 'assets/images/airlines/malaysia.svg', 'name' => 'Malaysia Airlines' ],
        [ 'path' => 'assets/images/airlines/maldivian.svg', 'name' => 'Maldivian' ],
        [ 'path' => 'assets/images/airlines/qatar.svg', 'name' => 'Qatar Airways' ],
        [ 'path' => 'assets/images/airlines/singapore.svg', 'name' => 'Singapore Airlines' ],
        [ 'path' => 'assets/images/airlines/srilankan.svg', 'name' => 'SriLankan Airlines' ],
        [ 'path' => 'assets/images/airlines/turkish.svg', 'name' => 'Turkish Airlines' ],
        [ 'path' => 'assets/images/airlines/us-bangla.svg', 'name' => 'US-Bangla Airlines' ],
        [ 'path' => 'assets/images/airlines/wizz.svg', 'name' => 'Wizz Air' ]
    ];
@endphp

<div class="relative h-[13vh] w-full overflow-hidden flex items-center justify-center">
    <!-- Direct Carousel Implementation - No JavaScript needed -->
    <div class="flex airline-carousel-track items-center">
        @foreach($airlineLogos as $logo)
            <div class="flex-none w-[200px] mx-2 md:w-[200px] md:mx-[10px] flex justify-center items-center">
                <div class="relative w-[150px] h-[100px] md:w-[150px] md:h-[100px] flex justify-center items-center">
                    <img
                        src="{{ asset($logo['path']) }}"
                        alt="{{ $logo['name'] }}"
                        class="max-w-[150px] max-h-[100px] object-contain filter grayscale hover:filter-none hover:scale-110 transition-all duration-300 ease-in-out"
                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTUwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2Y1ZjVmNSIvPjx0ZXh0IHg9Ijc1IiB5PSI1MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjOTk5IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+' + '{{ $logo['name'] }}' + '</text></svg>';"
                    />
                </div>
            </div>
        @endforeach

        {{-- Duplicate logos for infinite effect --}}
        @foreach($airlineLogos as $logo)
            <div class="flex-none w-[200px] mx-2 md:w-[200px] md:mx-[10px] flex justify-center items-center">
                <div class="relative w-[150px] h-[100px] md:w-[150px] md:h-[100px] flex justify-center items-center">
                    <img
                        src="{{ asset($logo['path']) }}"
                        alt="{{ $logo['name'] }}"
                        class="max-w-[150px] max-h-[100px] object-contain filter grayscale hover:filter-none hover:scale-110 transition-all duration-300 ease-in-out"
                        onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTUwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI2Y1ZjVmNSIvPjx0ZXh0IHg9Ijc1IiB5PSI1MCIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjOTk5IiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+' + '{{ $logo['name'] }}' + '</text></svg>';"
                    />
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .airline-carousel-track {
        animation: scroll 60s linear infinite;
        width: max-content;
        will-change: transform;
    }

    @media (max-width: 768px) {
        .airline-carousel-track {
            animation: scroll 40s linear infinite;
        }
    }
</style>
