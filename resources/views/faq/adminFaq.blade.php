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
        <div x-data="{ openCategory: false, showEditOverlay: false, categoryValue: '{{ $category }}', newCategoryValue: '{{ $category }}' }" 
        class="border rounded-lg p-4 mb-8 shadow-md bg-gray-800 border-gray-700">

        <!-- Category Display -->
        <div class="flex justify-between items-center mb-4 cursor-pointer" @click="openCategory = !openCategory">
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-white truncate" x-text="categoryValue"></h2>
            </div>
            @isAdmin
                <!-- Edit Button -->
                <button 
                    @click.stop="showEditOverlay = true" 
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded whitespace-nowrap">
                    Edit Category
                </button>
            @endIsAdmin
        </div>
        <div x-show="showEditOverlay" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700 w-1/2">
                <h2 class="text-2xl font-bold mb-4 text-white">Edit Category</h2>
                <form action="{{ route('faq.updateCategory') }}" method="POST">
                    @csrf
                    <input type="hidden" name="oldCategory" :value="categoryValue">
                    <div class="mb-4">
                        <label for="newCategoryName" class="block text-gray-50 font-medium">New Category Name</label>
                        <input 
                            type="text" 
                            id="newCategoryName" 
                            name="newCategory" 
                            x-model="newCategoryValue"
                            class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" 
                            required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" 
                            @click="showEditOverlay = false" 
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
        </div>
            <div x-show="openCategory" class="mt-2">
                @foreach($faqsInCategory as $faq)
                    <div x-data="{ openFaq: false, editFaq: false }" 
                        class="border rounded-lg p-4 mb-4 shadow-md bg-gray-700 border-gray-600"
                        :class="{
                            'bg-yellow-800 border-yellow-600': '{{ $faq->status }}' === 'pending',
                            'bg-gray-700 border-gray-600': '{{ $faq->status }}' !== 'pending'
                        }">
                        <!-- FAQ Header -->
                        <div class="flex justify-between items-center cursor-pointer" 
                            @click="if ('{{ $faq->status }}' !== 'pending') { openFaq = !openFaq } else { window.location.href = '{{ route('faq.details', $faq->id) }}' }">
                            <p class="text-lg font-medium text-white">{{ $faq->question }}</p>
                            @isAdmin
                                <div class="flex space-x-2">
                                    @if($faq->status === 'pending')
                                        <a href="{{ route('faq.details', $faq->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                            Approve
                                        </a>
                                        <form action="{{ route('faq.delete', $faq->id) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to reject this FAQ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <button @click.stop="openFaq = true; editFaq = true" 
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                            Edit
                                        </button>
                                        <form action="{{ route('faq.delete', $faq->id) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endIsAdmin
                        </div>

                        <!-- FAQ Answer and Edit Section -->
                        <div x-show="openFaq" class="mt-2 p-2 border-l-2 bg-gray-800 border-indigo-500">
                            <p class="text-white" x-show="!editFaq">{{ $faq->answer }}</p>
                            <div x-show="editFaq" class="mt-2">
                                <form action="{{ route('faq.update', $faq->id) }}" method="POST">
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
                                        <button type="button" @click="editFaq = false" 
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

</div>
@endsection
