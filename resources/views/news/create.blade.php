@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4 text-white">Create News Article</h1>

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-50 font-medium">Title</label>
            <input type="text" id="title" name="title" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-50 font-medium">Image</label>
            <x-image-input name="profile_picture" />
        </div>
        <div class="mb-4">
            <label for="content" class="block text-gray-50 font-medium">Content</label>
            <textarea id="content" name="content" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" rows="4" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create News Article
        </button>
    </form>
</div>
@endsection