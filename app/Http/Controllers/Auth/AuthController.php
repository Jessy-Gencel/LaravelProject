<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login',['pageType' => 'login']);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('home')->with('success', 'Login successful!');
        } else {
            return redirect()->back()->withErrors([
                'loginError' => 'The provided credentials are incorrect.'
            ]);
        }
    }

    public function showRegistrationForm()
    {
        return view('login',['pageType' => 'register']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/', 
                'regex:/[@$!%*?&]/' 
            ],
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $hashedPassword = Hash::make($request->input('password'));
        $userData = [
            'email' => $request->input('email'),
            'password' => $hashedPassword,
        ];
        $user = User::create($userData);
        $user->created_at = now();
        $user->save();

        $user->profile()->create([
            'username' => Str::random(12), 
        ]);
        $user->leaderboard()->create([
            'highscore' => 0,
        ]);
        return redirect()->route('home')->with('success', 'Registration successful!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
