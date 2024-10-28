@extends('layouts.pageWithProfile')

@section('content')
<form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-editable-field label="Username" value="{{ $user->profile->username }}" name="username" type="text" validationType="username"/>
    <x-editable-field label="Email" value="{{ $user->email }}" name="email" type="text" validationType="email" />
    
    <div class="mt-4">
        <label class="block text-gray-700 font-medium mb-1">Password</label>
        <a href="#" class="inline-block mt-2">
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