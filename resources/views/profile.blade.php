@extends('layouts.pageWithProfile')

@section('content')
<div class="flex items-center space-x-4 mb-6">
    <img src="{{ asset('storage/images/' . $user->profile->pfp) }}" alt="Profile Picture" class="w-24 h-24 rounded-full border border-gray-300">
    <div>
        <h2 class="text-gray-600 text-xl font-semibold">{{ $user->profile->username}}</h2>
        <p class="text-gray-600">{{ $user->email }}</p>
        <div class="flex flex-wrap gap-4 mt-4">
            @foreach ($user->achievements as $achievement)
                <div class="flex items-center p-2 rounded-lg shadow-md" 
                     style="background-color: {{ $achievement->color }};">
                    <!-- Badge Image -->
                    <img src="{{ asset('storage/images/' . $achievement->icon_path) }}" 
                         alt="{{ $achievement->name }}" 
                         class="w-12 h-12 rounded-full border border-gray-300" 
                         title="{{ $achievement->name }}">
                    <!-- Badge Text -->
                    <div class="ml-4">
                        <h3 class="text-white font-semibold">{{ $achievement->name }}</h3>
                        <p class="text-white text-sm">{{ $achievement->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-editable-field label="Username" value="{{ $user->profile->username }}" name="username" type="text" validationType="username" />
    <x-editable-field label="Email" value="{{ $user->email }}" name="email" type="text" validationType="email" />
    
    <div class="mt-4">
        <label class="block text-gray-700 font-medium mb-1">Password</label>
        <a href="{{ route('password.forgotPassword') }}" class="inline-block mt-2">
            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded">Reset Password</button>
        </a>
    </div>
    
    <x-editable-profile-picture image-url="{{ asset('storage/images/' . $user->profile->pfp) }}" label="Profile Picture"/>
    
    <div class="mt-4">
        <label for="birthday" class="block text-gray-700 font-medium mb-1">Birthday</label>
        <input type="date" id="birthday" name="birthday" value="{{ $user->profile->birthday ?? '' }}" class="border rounded p-2 w-full text-black" data-original-value="{{ $user->profile->birthday ?? '' }}">
    </div>  
    
    <x-editable-field label="Bio" value="{{ $user->profile->about_me }}" name="bio" type="textarea" />
    
    <button id="saveChangesButton" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hidden">Save Changes</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const saveChangesButton = document.getElementById('saveChangesButton');
        const inputs = document.querySelectorAll('input, textarea');

        function checkForChanges() {
            let hasChanges = false;
            inputs.forEach(input => {
                if (input.value !== input.getAttribute('data-original-value')) {
                    hasChanges = true;
                }
            });
            if (hasChanges) {
                saveChangesButton.classList.remove('hidden');
            } else {
                saveChangesButton.classList.add('hidden');
            }
        }

        inputs.forEach(input => {
            input.setAttribute('data-original-value', input.value);
            input.addEventListener('input', checkForChanges);
        });
    });
</script>
@endsection