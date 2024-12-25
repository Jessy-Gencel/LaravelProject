@extends('layouts.pageWithHeaderAndFooter')
@section('content')
<div id='faqContent' class="container mx-auto py-8">
    @isAdmin
        <div class="mt-8 mb-4">
            <a href="{{ route('addQuestion') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Question
            </a>
        </div>
    @endIsAdmin
    @foreach($faqs->groupBy('category') as $category => $faqsInCategory)
        <div x-data="{ openCategory: false }" class="border rounded-lg p-4 mb-8 shadow-md bg-gray-800 border-gray-700">
            <div class="flex justify-between items-center mb-4 cursor-pointer" @click="openCategory = !openCategory">
                <h2 class="text-xl font-semibold text-white">{{ $category }}</h2>
                @isAdmin
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                        Edit Category
                    </button>
                @endIsAdmin
            </div>
            <div x-show="openCategory" class="mt-2">
                @foreach($faqsInCategory as $faq)
                    <div x-data="{ openFaq: false, editFaq: false }" class="border rounded-lg p-4 mb-4 shadow-md bg-gray-700 border-gray-600">
                        <div class="flex justify-between items-center cursor-pointer" @click="if (!editFaq) openFaq = !openFaq">
                            <p class="text-lg font-medium text-white">{{ $faq->question }}</p>
                            @isAdmin
                                <div class="flex space-x-2">
                                    <button @click.stop="editFaq = !editFaq" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                        Edit
                                    </button>
                                    <form action="{{ route('faq.delete', $faq->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                            Discard
                                        </button>
                                    </form>
                                </div>
                            @endIsAdmin
                        </div>
                        <div x-show="openFaq" class="mt-2 p-2 border-l-2 bg-gray-800 border-indigo-500">
                            <p class="text-white" x-show="!editFaq">{{ $faq->answer }}</p>
                            <div x-show="editFaq" class="mt-2">
                                <form action="{{ route('faq.delete', $faq->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="question-{{ $faq->id }}" class="block text-gray-50 font-medium">Edit Question</label>
                                        <input type="text" id="question-{{ $faq->id }}" name="question" value="{{ $faq->question }}" 
                                               class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="answer-{{ $faq->id }}" class="block text-gray-50 font-medium">Edit Answer</label>
                                        <textarea id="answer-{{ $faq->id }}" name="answer" rows="3"
                                                  class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" required>{{ $faq->answer }}</textarea>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" @click="editFaq = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            Cancel
                                        </button>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
