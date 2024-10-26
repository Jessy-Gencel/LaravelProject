<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Main')</title>
    @vite(['resources/css/home.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 flex flex-col min-h-screen">
    <x-header />
    <main class="flex container mx-auto p-4 flex-grow justify-center items-center">
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
