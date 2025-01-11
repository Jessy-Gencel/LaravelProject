@extends('layouts.pageWithHeaderAndFooter')
@section('content')
<div id='newsContent' class="container mx-auto py-8" hidden>
    <div class="container mx-auto mt-4">
        @if(session('status'))
            <div class="mt-8 mb-4 text-lg {{ session('status_type', 'bg-blue-500') }} text-white font-bold py-4 px-4 rounded-lg shadow-md">
                {{ session('status') }}
            </div>
        @endif
    </div>
    @isAdmin
        <div class="mt-8 mb-4">
            <a href="{{ route('news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create News Article
            </a>
        </div>
    @endIsAdmin
        @foreach($newsItems as $news)
            <div x-data="{ openNews: false, showEditOverlay: false,openComment: false, openAllComments: false  }" class="border rounded-lg p-4 mb-8 shadow-md bg-gray-800 border-gray-700 relative">
                <div class="flex justify-between items-center mb-4 cursor-pointer" @click="if (!showEditOverlay) openNews = !openNews">
                    <h2 class="text-xl font-semibold text-white">{{ $news->title }}</h2>
                    @isAdmin
                        <div class="flex space-x-2">
                            <button @click.stop="showEditOverlay = true" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <form action="{{ route('news.destroy', $news->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this news article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Discard</button>
                            </form>
                        </div>
                    @endIsAdmin
                </div>
                <div x-show="openNews" class="mt-2">
                    <div class="flex space-x-4">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-1/4 h-1/4 rounded-lg shadow-lg">
                        <p class="text-white mb-4 w-1/2">{{ $news->content }}</p>
                    </div>
                    <p class="text-gray-400">Author: {{ $news->user->profile->username }}</p>
                    <p class="text-gray-400">Published on: {{ $news->created_at->format('F j, Y') }}</p>
                    @auth
                        <div class="mt-4">
                            <button @click="openComment = !openComment" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Leave a Comment</button>
                            <div x-show="openComment" class="mt-4">
                                <form action="{{route("news.comments.store")}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                                    <div class="mb-4">
                                        <label for="comment" class="block text-gray-50 font-medium">Comment</label>
                                        <textarea id="comment" name="comment" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" rows="3" required></textarea>
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" @click="openComment = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Post Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endauth
                    <div class="mt-4">
                        <button @click="openAllComments = !openAllComments" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Show Comments</button>
                        <div x-show="openAllComments" class="mt-4">
                            @foreach($news->comments as $comment)
                            <div x-data="{ editComment: false }" class="border rounded-lg p-4 mb-4 shadow-md bg-gray-700 border-gray-600">
                                <p class="text-white">{{ $comment->content }}</p>
                                <p class="text-gray-400 text-sm">By: {{ $comment->user->profile->username }} on {{ $comment->created_at->format('F j, Y') }}</p>
                                @isAdmin
                                    <div class="flex space-x-2 mt-2">
                                        <button @click="editComment = true" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                                        <form action="{{ route('news.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Discard</button>
                                        </form>
                                    </div>
                                    <div x-show="editComment" class="mt-4">
                                        <form action="{{ route('news.comments.update', $comment->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-4">
                                                <label for="edit-comment-{{ $comment->id }}" class="block text-gray-50 font-medium">Edit Comment</label>
                                                <textarea id="edit-comment-{{ $comment->id }}" name="content" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" rows="3" required>{{ $comment->content }}</textarea>
                                            </div>
                                            <div class="flex justify-end space-x-2">
                                                <button type="button" @click="editComment = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Comment</button>
                                            </div>
                                        </form>
                                    </div>
                                @endIsAdmin
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div x-show="showEditOverlay" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
                    <div class="bg-gray-800 p-6 rounded-lg shadow-md border border-gray-700 w-1/2">
                        <h2 class="text-2xl font-bold mb-4 text-white">Edit News Article</h2>
                        <form action="{{ route('news.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $news->id }}">
                            <div class="mb-4">
                                <label for="title" class="block text-gray-50 font-medium">Title</label>
                                <input type="text" id="title" name="title" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" value="{{ $news->title }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="image" class="block text-gray-50 font-medium">Image</label>
                                <x-image-input name="image" :currentImage="asset('storage/' . $news->image)" />
                            </div>
                            <div class="mb-4">
                                <label for="content" class="block text-gray-50 font-medium">Content</label>
                                <textarea id="content" name="content" class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700" rows="4" required>{{ $news->content }}</textarea>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="button" @click="showEditOverlay = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
</div>
@vite('resources/js/alpineLoadingWorkarounds/loadNews.js')
@endsection