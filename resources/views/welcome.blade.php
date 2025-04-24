<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Wanderlust Adventures mv') }}</title>

    <!-- Developer Information -->
    <meta name="author" content="Mohamed Humaam Athif">
    <meta name="description" content="Wanderlust Adventures mv - Your travel companion in the Maldives">
    <meta name="contact" content="+960 7211-404">
    <meta name="email" content="mohamed.humaam.athif@gmail.com">

    <!--
    ===========================================
    Developer: Mohamed Humaam Athif
    Contact: +960 7211-404
    Email: mohamed.humaam.athif@gmail.com
    GitHub: https://github.com/mohamed-humaam
    ===========================================
    -->

    <link rel="icon" href="{{ asset('assets/images/logo/logo.svg') }}" type="image/svg+xml">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

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
