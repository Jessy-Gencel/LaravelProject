<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/home.css', 'resources/js/app.js',"resources/js/PFPDropDownMenu.js"])
    <title>Game</title>
    @vite(['resources/js/gameJS/mainPage.js','resources/css/game.css'])
</head>
<body id="gameWindow" >
    @yield('content')
</body>
</html>
