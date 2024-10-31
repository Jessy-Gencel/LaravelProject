@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div id="faq_page" class="container mx-auto py-8" hidden>
    <h1 class="text-2xl font-bold mb-6">Frequently Asked Questions</h1>
    @foreach($faqs->groupBy('category') as $category => $faqsInCategory)
        <div x-data="{ openCategory: false }" class="border rounded-lg p-4 mb-8 shadow-md bg-gray-800 border-gray-700">
            <div class="flex justify-between items-center mb-4 cursor-pointer" @click="openCategory = !openCategory">
                <h2 class="text-xl font-semibold text-white">{{ $category }}</h2>
                @if(auth()->user()->isAdmin)
                    <button class="text-indigo-500 hover:text-indigo-700" onclick="editCategory('{{ $category }}')">Edit Category</button>
                @endif
            </div>
            <div x-show="openCategory" class="mt-2">
                @foreach($faqsInCategory as $faq)
                    <div x-data="{ openFaq: false }" class="mb-4">
                        <div class="flex justify-between items-center cursor-pointer p-2 rounded shadow-sm hover:bg-gray-700 bg-gray-900 text-white"
                            @click="openFaq = !openFaq">
                            <p class="font-medium">{{ $faq->question }}</p>
                            @if(auth()->user()->isAdmin)
                                <button class="text-indigo-500 hover:text-indigo-700" onclick="editFaq('{{ $faq->id }}')">Edit</button>
                            @endif
                        </div>
                        <div x-show="openFaq" class="mt-2 p-2 border-l-2 bg-gray-800 border-indigo-500">
                            <p class="text-white">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    <div class="mt-6 flex flex-col items-start space-y-2">
        @if(auth()->user()->isAdmin)
            <a href="{{ route('addQuestion') }}" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">
                Add New Question
            </a>
        @else
            <label for="ask-question" class=" text-gray-50 font-medium">
                Can't find what you're looking for?
            </label>
            <a href="{{ route('addQuestion') }}" class="bg-blue-500 text-white py-2 px-6 rounded hover:bg-blue-600">
                Ask a new question!
            </a>
        @endif
    </div>
</div>
@vite('resources/js/alpineLoadingWorkarounds/loadFAQS.js')
@endsection
