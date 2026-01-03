<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Knowledge Nest — Admin</title>

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body class="bg-nest-100 text-slate-800 antialiased">
    <div x-data="{ mobileOpen: false }" class="min-h-screen flex">
        @include('components.adminDrawer')
        <div class="flex-1 flex flex-col">
            @include('components.adminNavbar')
            @yield('content')
        </div>
    </div>
</body>

</html>