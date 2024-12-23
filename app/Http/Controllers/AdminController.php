<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function getBlacklist()
    {
        $users = User::leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.id', 'users.email', 'users.blacklisted', 'profiles.username') // Select the username from the profiles table
        ->get();
        return view('admin.blacklist',compact('users'));
    }

    public function blacklistUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->blacklisted = !$user->blacklisted;
        $user->save();
        return redirect()->route('admin.blacklist')
                        ->with('status', 'User blacklisted status updated successfully!');
    }
}
