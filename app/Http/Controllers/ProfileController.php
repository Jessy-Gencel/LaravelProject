<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function edit(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'username' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['username', 'email', 'birthday', 'bio']);
        $user->email = $data['email'];
        $user->save();

        $user->profile->update([
            'username' => $data['username'],
            'birthday' => $data['birthday'],
            'about_me' => $data['bio'],
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $filename, 'public');
            $user->profile->pfp = $filename;
            $user->profile->save();
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
