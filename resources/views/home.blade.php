@extends('layouts.pageWithHeaderAndFooter')

@section('content')
    <div class="text-center">
        <h2 class="text-2xl font-bold">Welcome to My Laravel App!</h2>
        <p>This is the home page of your application.</p>
        <a href="#" class="mt-4 inline-block bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">Get Started</a>
        @if(session('success'))
            <div class="alert alert-success">
                <h1>{{ session('success') }}</h1>
            </div>
        @endif
    </div>
@endsection

