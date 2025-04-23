<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WanderLust</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Add your custom animations here */
        @keyframes indicator-enter {
            0% {
                transform: translateX(-50%) scaleX(0);
                opacity: 0;
            }
            100% {
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }
        }

        .animate-indicator {
            animation: indicator-enter 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }
    </style>
</head>
<body>
<!-- Include the navbar -->
@include('components.navigations.navbar')

@include('components.homepage.hero')

@include('components.homepage.airline')

@include('components.homepage.why-us')

@include('components.navigations.footer')
</body>
</html>
