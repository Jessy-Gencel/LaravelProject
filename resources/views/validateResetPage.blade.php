@extends('layouts.pageWithHeaderAndFooter')

@section('title', 'Validate Reset Code')

@section('content')
<div class="container mx-auto py-10">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg mx-auto">
        <h1 class="text-2xl font-bold text-white text-center mb-4">Validate Your Reset Code</h1>
        <p class="text-gray-300 text-center mb-6">
            Please enter the reset code sent to your email address.
        </p>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                {{ session('status') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                <ul class="list-none list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.validateResetCode') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="code" class="block text-gray-300 mb-2">Reset Code</label>
                <input type="text" name="code" id="code" class="w-full p-3 rounded bg-gray-700 text-white focus:ring focus:ring-blue-500" required>
                @error('code')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Validate Code
            </button>
        </form>
    </div>
</div>
@endsection
