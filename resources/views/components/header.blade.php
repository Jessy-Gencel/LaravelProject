<header class="bg-gray-800 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold text-white">Alien Defense</h1>
        <nav class="flex space-x-4">
            <ul class="flex space-x-4 items-center">
                <li><a href="{{ route('home') }}" class="hover:text-gray-400 text-white">Home</a></li>
                <li><a href="{{ route('leaderboard.index') }}" class="hover:text-gray-400 text-white">Leaderboard</a></li>
                <li><a href="{{route('news.index')}}" class="hover:text-gray-400 text-white">News</a></li>
                <li><a href="{{route('faq')}}" class="hover:text-gray-400 text-white">FAQ</a></li>
                <li><a href="{{route('contact.show')}}" class="hover:text-gray-400 text-white">Contact</a></li>
                <li class="relative">
                    @if (Auth::check())
                        <div class="profile-circle cursor-pointer">
                            <img src="{{ asset('storage/images/' . Auth::user()->profile->pfp) }}" 
                                 alt="Profile Picture" 
                                 class="w-10 h-10 rounded-full border border-gray-200" />
                        </div>
                        
                        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:rounded-lg">View Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 hover:rounded-lg">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-gray-400 text-white">Login</a>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
</header>
