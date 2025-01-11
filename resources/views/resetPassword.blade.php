@extends('layouts.pageWithHeaderAndFooter')

@section('title', 'Reset Password')

@section('content')
<div class="container mx-auto py-10">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-white text-center mb-4">Reset Your Password</h1>
        <p class="text-gray-300 text-center mb-6">
            Enter your new password below and confirm it.
        </p>

        {{-- Success Message (Validation Code Confirmed) --}}
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                {{ session('status') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                <ul class="list-inside list-none">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <!-- Hidden fields for email and code -->
            <input type="hidden" name="email" value="{{ session('reset_email') }}">
            <input type="hidden" name="code" value="{{ session('reset_code') }}">
            
            <!-- New Password Input -->
            <div class="mb-4">
                <label for="password" class="block text-gray-300 mb-2">New Password</label>
                <input type="password" name="password" id="password" class="w-full p-3 rounded bg-gray-700 text-white focus:ring focus:ring-blue-500" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Confirm Password Input -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-300 mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 rounded bg-gray-700 text-white focus:ring focus:ring-blue-500" required>
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
