<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\ProfileComment;
use Illuminate\Support\Facades\Log;
use App\Models\Achievement;

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
        $signupBadge = Achievement::where('name', 'Explorer')->first(); // Adjust the badge name as needed

        if ($signupBadge && !$user->achievements->contains($signupBadge->id)) {
            $user->achievements()->attach($signupBadge->id, [
                'awarded_at' => now(),
            ]);
        }
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
    public function viewProfile($id)
    {
        $user = User::with('profile')->find($id);
        return view('profile_view', compact('user'));
    }
    public function postComment(Request $request,$id)
    {
        Log::info($id);
        Log::info(auth()->id());
        Log::info($request);
        $validated = $request->validate([
            'comment' => 'required|string|max:500',
        ]);
        // Create the comment
        ProfileComment::create([
            'content' => $validated['comment'],
            'profile_id' => $id,
            'user_id' => auth()->id(), // The authenticated user's ID
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Comment added successfully!');
    }
    public function deleteComment($id)
    {
        $comment = ProfileComment::find($id);
        $comment->delete();
        return redirect()->back()->with('status', 'Comment deleted successfully!');
    }
}
