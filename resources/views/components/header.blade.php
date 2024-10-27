<header class="bg-gray-800 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">My Laravel App</h1>
        <nav class="flex space-x-4">
            <ul class="flex space-x-4">
                <li><a href="{{route('home')}}" class="hover:text-gray-400">Home</a></li>
                <li><a href="{{route('uploadImage')}}" class="hover:text-gray-400">upload Image</a></li>
                <li><a href="#" class="hover:text-gray-400">About</a></li>
                <li><a href="#" class="hover:text-gray-400">Contact</a></li>
                <li>
                    @if (Auth::check())
                    <div class="profile-circle">
                        <img src="{{ Auth::user()->profile->pfp }}" alt="Profile Picture" class="rounded-circle" />
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-gray-400">Login</a>
                    @endif

                </li>
            </ul>
        </nav>
    </div>
</header>
