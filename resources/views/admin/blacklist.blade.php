@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-semibold text-gray-100 mb-4">User Blacklisting</h1> 

    @if(session('status'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('status') }}
        </div>
    @endif

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">Username</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Blacklisted</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b hover:bg-white hover:text-gray-800 hover:font-bold">
                    <td class="px-4 py-2 font-bold">{{ $user->username }}</td>
                    <td class="px-4 py-2 font-bold">{{ $user->email }}</td>
                    <td class="px-4 py-2 font-bold">
                        <span class="text-sm {{ $user->blacklisted ? 'text-red-500' : 'text-green-500' }}">
                            {{ $user->blacklisted ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 font-bold">
                        <form action="{{ route('admin.blacklist.toggle', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                {{ $user->blacklisted ? 'Unblacklist' : 'Blacklist' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection