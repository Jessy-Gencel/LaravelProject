<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Main')</title>
    @vite(['resources/css/home.css', 'resources/js/app.js',"resources/js/PFPDropDownMenu.js"])
</head>
<body class="bg-gray-900 flex flex-col min-h-screen">
    <x-header />
    <main class="flex container mx-auto p-4 flex-grow justify-center items-center">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4">Profile</h1>
        
            <div class="bg-white p-6 rounded-lg shadow-lg">
                @yield('content')
            </div>
        </div>
    </main>
    <x-footer />
</body>
</html>