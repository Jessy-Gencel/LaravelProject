@extends('layouts.pageWithHeaderAndFooter')

@section('title', 'Forgot Password')

@section('content')
<div class="container mx-auto py-10">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-white text-center mb-4">Forgot Your Password?</h1>
        <p class="text-gray-300 text-center mb-6">
            Enter your email address below to receive a reset code.
        </p>
        <form action="{{ route('password.resetCode') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-300 mb-2">Email Address</label>
                <input type="email" name="email" id="email" class="w-full p-3 rounded bg-gray-700 text-white focus:ring focus:ring-blue-500" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Send Reset Code
            </button>
        </form>
        @if (session('status'))
            <p class="text-green-500 text-sm mt-4">{{ session('status') }}</p>
        @endif
    </div>
</div>
@endsection
