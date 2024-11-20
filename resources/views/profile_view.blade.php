@extends('layouts.pageWithProfile')

@section('content')
<div class="container mx-auto mt-6">
    <div class="bg-white shadow rounded-lg p-6 text-black">
        <div class="flex items-center">
            <img src="{{ asset('storage/images/' . $user->profile->pfp) }}" 
                 alt="Profile Picture" class="w-20 h-20 rounded-full mr-6">
            <h2 class="text-2xl font-bold">{{ $user->profile->username }}</h2>
        </div>
        <div class="mt-4">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>About:</strong> {{ $user->profile->about_me }}</p>
            <p><strong>Birthday:</strong> {{ $user->profile->birthday }}</p>
            <p><strong>Played Since:</strong> {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p>
        </div>
    </div>
</div>
@endsection
