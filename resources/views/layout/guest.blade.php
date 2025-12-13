<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Knowledge Nest — Community Skills</title>

    <style>
        /* Glassmorphism Utilities */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .glass-dark {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Smooth Image Transitions */
        .img-zoom-container {
            overflow: hidden;
        }

        .img-zoom {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .group:hover .img-zoom {
            transform: scale(1.1);
        }
    </style>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800 antialiased selection:bg-brand-200 selection:text-brand-900">
    @include('components.navbar')

    @yield('content')

    @include('components.footer')
    @stack('scripts')
</body>

</html>