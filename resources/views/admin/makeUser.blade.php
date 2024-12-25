@extends('layouts.pageWithHeaderAndFooter')
@section('content')
<div class="container mx-auto p-4">
    <div class="card bg-white shadow-md rounded-lg p-6">
        <h2 class="text-center text-2xl font-bold mb-4">Create User</h2>
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="username" class="block text-gray-800 font-medium">Username</label>
                <input type="text" class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="username" name="username" required>
            </div>
            <div class="form-group mb-4">
                <label for="email" class="block text-gray-800 font-medium">Email</label>
                <input type="email" class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="email" name="email" required>
            </div>
            <div class="form-group mb-4">
                <label for="password" class="block text-gray-800 font-medium">Password</label>
                <input type="password" class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="password" name="password" required>
            </div>
            <div class="form-group mb-4">
                <label for="password_confirmation" class="block text-gray-800 font-medium">Confirm Password</label>
                <input type="password" class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="password_confirmation" name="password_confirmation" required>
            </div>
            <x-editable-profile-picture image-url="NONE" label="Profile Picture"/>
            <div class="form-group mb-4">
                <label for="birthday" class="block text-gray-800 font-medium">Date of Birth</label>
                <input type="date" class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="birthday" name="birthday" required>
            </div>
            <div class="form-group mb-4">
                <label for="bio" class="block text-gray-800 font-medium">Bio</label>
                <textarea class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="bio" name="bio" rows="3"></textarea>
            </div>
            <div class="form-group mb-4">
                <label for="is_admin" class="block text-gray-800 font-medium">Admin</label>
                <select class="form-control mt-1 block w-full bg-gray-300 text-gray-800 border-gray-600 rounded-md shadow-lg" id="is_admin" name="is_admin">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 shadow-lg">Create User</button>
        </form>        
    </div>
</div>
@endsection