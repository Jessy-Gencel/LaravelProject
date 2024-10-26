<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login',['pageType' => 'login']);
    }
    public function login(Request $request)
    {
    }
    public function showRegistrationForm()
    {
        return view('login',['pageType' => 'register']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:50',
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
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
        ];
        $user = User::create($userData);
        $user->created_at = now();
        $user->save();
        return redirect()->route('home')->with('success', 'Registration successful!');
    }
}
