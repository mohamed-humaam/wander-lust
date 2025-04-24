<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WanderLust</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome CDN for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
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
@include('components.navigations.navbar')

@include('components.homepage.hero')

@include('components.homepage.airline')

@include('components.homepage.why-us')

@include('components.homepage.testimonials')

@include('components.navigations.footer')
</body>
</html>
