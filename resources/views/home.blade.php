@extends('layouts.pageWithHeaderAndFooter')

@section('content')
    @isNotAdmin
        <div class="relative h-screen w-full max-w-800 max-h-800 mx-auto border-4 border-gray-700 rounded-lg overflow-hidden" style="background-image: url('{{ asset('storage/assets/waJ8FkAH4NZ3BNG2rqLex54yBinXFUBNimKiExDe.jpg') }}'); background-size: cover; background-position: center;">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <a href="{{route('game.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-full text-2xl">
                    Play
                </a>
            </div>
        </div>
    @endIsNotAdmin
    @isAdmin
        <div class="container mx-auto py-10">
            <div class="bg-gray-800 text-center mb-8 p-6 rounded-lg shadow-lg">
                <h1 class="text-4xl font-extrabold text-white tracking-tight mb-2">
                    Welcome to the Admin Dashboard!
                </h1>
                <p class="text-lg text-gray-300">
                    Manage your platform with ease. Select a functionality below:
                </p>
            </div>
        
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card for Blacklisting -->
                <x-admin-card 
                    icon="bi bi-x-circle-fill" 
                    iconColor="text-danger" 
                    title="User Management" 
                    description="Manage users on your platform." 
                    route="{{ route('admin.userManagement') }}" 
                    buttonText="Manage" 
                />
        
                <!-- Card for News Page -->
                <x-admin-card 
                    icon="bi bi-newspaper" 
                    iconColor="text-success" 
                    title="News Page" 
                    description="Update and manage the latest news on your platform." 
                    route="{{ route('news.index') }}" 
                    buttonText="Manage" 
                />
        
                <!-- Card for FAQs -->
                <x-admin-card 
                    icon="bi bi-question-circle-fill" 
                    iconColor="text-info" 
                    title="FAQs" 
                    description="Edit and manage frequently asked questions." 
                    route="{{ route('faq.main') }}" 
                    buttonText="Manage" 
                />
        
                <!-- Card for Contact Us Forms -->
                <x-admin-card 
                    icon="bi bi-envelope-fill" 
                    iconColor="text-warning" 
                    title="Contact Us Forms" 
                    description="View and respond to user inquiries." 
                    route="{{ route('admin.contactDashboard') }}" 
                    buttonText="Manage" 
                />
        
                <!-- Card for Leaderboards -->
                <x-admin-card 
                    icon="bi bi-trophy-fill" 
                    iconColor="text-primary" 
                    title="Leaderboards" 
                    description="View and manage game leaderboards." 
                    route="{{ route('leaderboard.index') }}" 
                    buttonText="Manage" 
                />
        
                <!-- Card for Play Game -->
                <x-admin-card 
                    icon="bi bi-controller" 
                    iconColor="text-secondary" 
                    title="Play Game" 
                    description="Launch the game directly from the admin panel !" 
                    route="{{ route('game.index') }}" 
                    buttonText="Play" 
                />
            </div>
        </div>
    @endIsAdmin
    @if (!Auth::check())
        <div class="container mx-auto py-10">
            <div class="bg-gray-800 text-center mb-8 p-6 rounded-lg shadow-lg">
                <h1 class="text-4xl font-extrabold text-white tracking-tight mb-2">
                    Welcome to Alien Defense!
                </h1>
                <p class="text-lg text-gray-300">
                    Please login to play the game.
                </p>
            </div>
        </div>
    @endif
@endsection