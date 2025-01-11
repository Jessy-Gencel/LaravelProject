@extends('layouts.pageWithHeaderAndFooter')

@section('content')
@if($pageType == 'register')
    @vite('resources/js/validateRegistration.js')
@endif
<div class="flex items-center justify-center bg-gray-900 h-full flex-grow">
    <div class="bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-sm">
        <div class="flex justify-center mb-4">
            <button id="loginButton" class="w-1/2 py-2 {{ $pageType == 'login' ? 'bg-blue-600' : 'bg-transparent' }} hover:bg-blue-500 rounded-md text-white font-semibold mx-1" onclick="window.location.href='{{ route('login') }}'">Login</button>
            <button id="signupButton" class="w-1/2 py-2 {{ $pageType == 'register' ? 'bg-green-600' : 'bg-transparent' }} hover:bg-green-500 rounded-md text-white font-semibold mx-1" onclick="window.location.href='{{ route('register') }}'">Sign Up</button>
        </div>
        @if ($pageType == 'login')
            <h2 id="formTitle" class="text-2xl font-bold text-center text-white mb-4">Login</h2>
            <form id="authForm" action="{{ route('login') }}" method="POST">
                @csrf
                <div id="emailField" class="mb-4">
                    <label for="email" class="block text-gray-300">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white placeholder-gray-400">
                </div>
                <div id="passwordField" class="mb-4">
                    <label for="password" class="block text-gray-300">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white placeholder-gray-400">
                </div>
                <div class="mb-4">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="text-gray-300">Remember Me</label>
                </div>  
                <div class="mb-4">
                    <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-500 rounded-md text-white font-semibold">Login</button>
                </div>              
                @if ($errors->has('loginError'))
                    <div class="text-red-500 mb-4">{{ $errors->first('loginError') }}</div>
                @endif
                <div id="forgotPasswordLink" class="text-center">
                    <a href="{{ route('password.forgotPassword') }}" class="text-gray-400 hover:text-gray-300">Forgot your password?</a>
                </div>
            </form>
        @elseif ($pageType == 'register')
            <h2 id="formTitle" class="text-2xl font-bold text-center text-white mb-4">Register</h2>
            <form id="authForm" action="{{ route('register') }}" method="POST">
                @csrf
                <div id="emailField" class="mb-4">
                    <label for="email" class="block text-gray-300">Email</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white placeholder-gray-400">
                </div>
                <div id="passwordField" class="mb-4">
                    <label for="password" class="block text-gray-300">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white placeholder-gray-400">
                </div>
                <div id="confirmPasswordField" class="mb-4">
                    <label for="password_confirmation" class="block text-gray-300">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 bg-gray-700 text-white placeholder-gray-400">
                </div>
                <div class="mb-4">
                    <button type="submit" class="w-full py-2 bg-green-600 hover:bg-green-500 rounded-md text-white font-semibold">Register</button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
