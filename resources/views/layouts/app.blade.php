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
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Any additional CSS you need -->
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
<!-- Include the navbar component -->
@include('components.navigations.navbar')

<!-- Main content -->
<main class="p-0">
    @yield('content')
</main>

@include('components.navigations.footer')

<!-- Scripts -->
<script>
    // Any global scripts you need
</script>
</body>
</html>
