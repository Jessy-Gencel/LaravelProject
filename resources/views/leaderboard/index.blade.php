@extends('layouts.pageWithHeaderAndFooter')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Leaderboard</h1>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-6 py-3">Rank</th>
                    <th class="border border-gray-300 px-6 py-3">User</th>
                    <th class="border border-gray-300 px-6 py-3">Highscore</th>
                    @isAdmin
                        <th class="border border-gray-300 px-6 py-3 w-auto">Actions</th>
                    @endIsAdmin
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboard as $index => $entry)
                    <tr class="cursor-pointer hover:bg-gray-100 border-collapse"
                        onclick="window.location.href='{{ route('profile.view', $entry->user->id) }}'">
                        <td class="border border-gray-300 px-6 py-3">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-6 py-3 min-w-96">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/images/' . $entry->user->profile->pfp) }}" alt="Profile Picture" class="w-10 h-10 rounded-full mr-3">
                                {{ $entry->user->profile->username }}
                            </div>
                        </td>
                        <td class="border border-gray-300 px-6 py-3">{{ $entry->highscore }}</td>
                        @isAdmin
                            <td class="border-y border-gray-300 border-collapse py-4 text-center">
                                <form class="inline-block" action="{{ route('admin.leaderboard.illegitimate', $entry->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                        Report as Illegitimate
                                    </button>
                                </form>
                            </td>
                        @endIsAdmin
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
