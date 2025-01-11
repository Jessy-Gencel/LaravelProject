@extends('layouts.pageWithProfile')

@section('content')
<divs class="container mx-auto mt-4">
    @if(session('status'))
        <div class="mt-8 mb-4 text-lg {{ session('status_type', 'bg-blue-500') }} text-white font-bold py-4 px-4 rounded-lg shadow-md">
            {{ session('status') }}
        </div>
    @endif
</divs>
<div class="container mx-auto mt-6">
    <!-- User Profile Information -->
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

    <!-- Comments Section -->
    <div class="bg-white text-black shadow rounded-lg p-6 mt-6">
        <h3 class="text-xl font-bold mb-4">Comments</h3>

        <!-- Add Comment Form -->
        <form action="{{ route('profile.postComment', $user->id) }}" method="POST" class="mb-6">
            @csrf
            <textarea 
                name="comment" 
                rows="3" 
                class="w-full border-gray-200 rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400 placeholder-gray-500" 
                placeholder="Leave a comment..."></textarea>
            <button type="submit" class="mt-2 bg-green-500 hover:bg-green-600 text-white py-1 px-4 rounded">
                Submit
            </button>
        </form>

        <!-- Comments List -->
        @foreach($user->profileComments as $comment)
        <div class="bg-gray-100 p-4 rounded shadow mb-4">
            <div class="flex justify-between items-center">
                <p class="font-bold text-gray-800">{{ $comment->author->profile->username }}</p>
                <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p class="mt-2 text-gray-700">{{ $comment->content }}</p>
            
            @isAdmin
            <div class="mt-2 flex gap-2">
                <!-- Delete Button -->
                <form action="{{ route('profile.deleteComment', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">
                        Delete
                    </button>
                </form>
            </div>
            @endIsAdmin
        </div>
        @endforeach
    </div>
</div>
@endsection
