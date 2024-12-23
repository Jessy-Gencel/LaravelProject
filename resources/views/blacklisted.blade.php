@extends('layouts.bannedPage')

@section('content')
    <div class="min-h-screen bg-red-800 flex items-center justify-center w-full">
        <div class="text-center p-8 bg-red-600 text-white rounded-lg shadow-lg">
            <h1 class="text-4xl font-bold mb-4">You Have Been Banned!</h1>
            <p class="text-xl mb-6">Your account has been blacklisted from accessing the platform. Please contact support if you believe this is a mistake.</p>
        </div>
    </div>
@endsection
