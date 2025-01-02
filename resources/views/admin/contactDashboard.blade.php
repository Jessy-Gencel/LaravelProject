@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div id='contactRequests' class="container mx-auto py-8">
    <h1 class="text-2xl font-bold text-white mb-4">Contact Requests</h1>

    <!-- Unresolved Requests Section -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-white mb-4">Unresolved Requests</h2>
        @forelse ($unresolvedRequests as $request)
            <div x-data="{ open: false, response: '' }" 
                class="border rounded-lg p-4 mb-4 shadow-md bg-gray-700 border-gray-600">
                <!-- Header -->
                <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                    <div>
                        <p class="text-lg font-medium text-white">{{ $request->firstname }} {{ $request->lastname }}</p>
                        <p class="text-gray-300">{{ $request->email }}</p>
                    </div>
                    <span x-text="open ? '-' : '+'"
                          class="text-white font-bold text-xl cursor-pointer"></span>
                </div>

                <!-- Message and Response Form -->
                <div x-show="open" class="mt-4 bg-gray-800 p-4 rounded-lg border border-gray-700">
                    <p class="text-white mb-4"><strong>Message:</strong> {{ $request->message }}</p>
                    <form action="{{ route('admin.contactRequestResponse', $request->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $request->firstname }} {{ $request->lastname }}">
                        <input type="text" name="subject" 
                               class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700 mb-4"
                               placeholder="Subject" required>
                        <textarea x-model="response" name="response" rows="3" 
                                  class="border rounded p-2 w-full bg-gray-900 text-white border-gray-700"
                                  placeholder="Only include the actual response. Introductions, greetings, and salutations will be generated for you." required></textarea>
                        <!-- Button Container -->
                        <div class="mt-4 flex justify-end space-x-4">
                            <!-- Respond Button -->
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    :disabled="!response">
                                Respond
                            </button>
                    </form>
                    <form action="{{ route('admin.contactRequestDelete', $request->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Delete Button -->
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                        </div>
                </div>
                
            </div>
        @empty
            <p class="text-gray-300">No unresolved requests at the moment.</p>
        @endforelse
    </div>

    <!-- Resolved Requests Section -->
    <div>
        <h2 class="text-xl font-semibold text-white mb-4">Resolved Requests</h2>
        @forelse ($resolvedRequests as $request)
            <div x-data="{ open: false }" 
                class="border rounded-lg p-4 mb-4 shadow-md bg-gray-700 border-gray-600">
                <!-- Header -->
                <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                    <div>
                        <p class="text-lg font-medium text-white">{{ $request->firstname }} {{ $request->lastname }}</p>
                        <p class="text-gray-300">{{ $request->email }}</p>
                    </div>
                    <span x-text="open ? '-' : '+'"
                          class="text-white font-bold text-xl cursor-pointer"></span>
                </div>

                <!-- Resolved Details -->
                <div x-show="open" class="mt-4 bg-gray-800 p-4 rounded-lg border border-gray-700">
                    <p class="text-white mb-4"><strong>Message:</strong> {{ $request->message }}</p>
                    <p class="text-white mb-4"><strong>Response:</strong> {{ $request->response }}</p>
                    <p class="text-gray-400 text-sm">
                        <strong>Resolved By:</strong> {{ $request->response_by }} <br>
                        <strong>Resolved At:</strong> {{ $request->resolved_at }}
                    </p>
                </div>
            </div>
        @empty
            <p class="text-gray-300">No resolved requests available.</p>
        @endforelse
    </div>
</div>
@endsection
