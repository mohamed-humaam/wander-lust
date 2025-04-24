<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'WanderLust') }}</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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
<main class="pt-20">
    @yield('content')
</main>

@include('components.navigations.footer')

<!-- Scripts -->
<script>
    // Any global scripts you need
</script>
</body>
</html>
