@extends('layouts.pageWithHeaderAndFooter')

@section('content')
    <div class="relative h-screen w-full max-w-800 max-h-800 mx-auto border-4 border-gray-700 rounded-lg overflow-hidden" style="background-image: url('{{ asset('storage/assets/waJ8FkAH4NZ3BNG2rqLex54yBinXFUBNimKiExDe.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <a href="{{route('game.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-full text-2xl">
                Play
            </a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            <h1>{{ session('success') }}</h1>
        </div>
    @endif
@endsection