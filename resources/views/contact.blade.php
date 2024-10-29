@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4 text-white">Contact Us</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="firstname" class="block text-gray-300 font-medium">First Name</label>
            <input type="text" id="firstname" name="firstname" class="border rounded p-2 w-full bg-gray-800 text-white" required>
        </div>
        <div class="mb-4">
            <label for="lastname" class="block text-gray-300 font-medium">Last Name</label>
            <input type="text" id="lastname" name="lastname" class="border rounded p-2 w-full bg-gray-800 text-white" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-300 font-medium">Email</label>
            <input type="email" id="email" name="email" class="border rounded p-2 w-full bg-gray-800 text-white" required>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-300 font-medium">Message</label>
            <textarea id="message" name="message" class="border rounded p-2 w-full bg-gray-800 text-white" rows="6" required></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">
            Send Message
        </button>
    </form>
</div>
@endsection
