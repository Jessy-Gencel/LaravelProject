@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4 text-white">Add a New Question</h1>

    <form action="{{ route('faq.saveFAQ') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="category" class="block text-gray-300 font-medium">Category</label>
            <div id="category-container">
                <select id="category-select" name="category" class="border rounded p-2 w-full bg-gray-800 text-white" required>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                        <option value="add-new">Add New</option>
                    @else
                        <option value="add-new">Add New</option>
                    @endif
                </select>
                <input type="text" id="category-input" name="category" class="border rounded p-2 w-full bg-gray-800 text-white hidden" placeholder="Enter new category">
            </div>
        </div>
        <div class="mb-4">
            <label for="title" class="block text-gray-300 font-medium">Question Title</label>
            <input type="text" id="title" name="title" class="border rounded p-2 w-full bg-gray-800 text-white" required>
        </div>
        @if(auth()->check() && auth()->user()->is_admin)
            <div class="mb-4">
                <label for="answer" class="block text-gray-300 font-medium">Answer</label>
                <textarea id="answer" name="answer" class="border rounded p-2 w-full bg-gray-800 text-white" rows="4"></textarea>
            </div>
        @else
            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-medium">Question Description</label>
                <textarea id="description" name="description" class="border rounded p-2 w-full bg-gray-800 text-white" rows="4" required></textarea>
            </div>
        @endif

        <button class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">
            Submit Question
        </button>
    </form>
</div>

@vite('resources/js/addFaq.js')
@endsection