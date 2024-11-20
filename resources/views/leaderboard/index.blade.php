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
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboard as $index => $entry)
                    <tr class="cursor-pointer hover:bg-gray-100"
                        onclick="window.location.href='{{ route('profile.view', $entry->user->id) }}'">
                        <td class="border border-gray-300 px-6 py-3">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-6 py-3">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/images/' . $entry->user->profile->pfp) }}" alt="Profile Picture" class="w-10 h-10 rounded-full mr-3">
                                {{ $entry->user->profile->username }}
                            </div>
                        </td>
                        <td class="border border-gray-300 px-6 py-3">{{ $entry->highscore }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
