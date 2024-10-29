<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Main')</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/home.css', 'resources/js/app.js',"resources/js/PFPDropDownMenu.js"])
</head>
<body class="bg-gray-900 flex flex-col min-h-screen">
    <x-header />
    <main class="flex container mx-auto p-4 flex-grow justify-center items-center">
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
