@extends('layouts.pageWithHeaderAndFooter')
@section('content')
    <div class="container mx-auto p-4 bg-gray-800 text-white rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Edit FAQ</h1>
        <!-- FAQ Form -->
        <form action="{{ route('faq.approve', $faq->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="question" class="block text-gray-50 font-medium">Question</label>
                <input type="text" id="question" name="question" value="{{ old('question', $faq->question) }}" 
                       class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-50 font-medium">Description</label>
                <p id="description" class="text-gray-300">{{ $faq->description ?? 'No description provided.' }}</p>
            </div>
            <div class="mb-4">
                <label for="answer" class="block text-gray-50 font-medium">Answer</label>
                <textarea id="answer" name="answer" rows="5" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" required>{{ old('answer', $faq->answer) }}</textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="window.history.back()" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
