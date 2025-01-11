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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetCode;


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
            return redirect()->route('home');
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
    public function showBlacklisted()
    {
        return view('blacklisted');
    }
    public function showForgotPasswordForm()
    {
        return view('forgotPassword');
    }
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }
        $resetCode = Str::random(6);
        $user->password_reset_code = $resetCode;
        $user->save();
        Mail::to($user->email)->send(new PasswordResetCode($resetCode));
        return redirect()->route('password.validateResetPage', ['token' => $resetCode]);
    }
    public function showResetPasswordForm()
    {
        return view('resetPassword');
    }
    public function performPasswordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required',
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
        $user = User::where('email', $request->input('email'))->first();
        if ($user->password_reset_code !== $request->input('code')) {
            return back()->withErrors(['code' => 'The provided reset code is incorrect.'])->withInput();
        }
        $hashedPassword = Hash::make($request->input('password'));
        $user->password = $hashedPassword;
        $user->password_reset_code = null;
        session()->forget(['reset_email', 'reset_code']);
        $user->save();
        session()->flash('status', 'Your password has been reset successfully. You can now log in.');
        return redirect()->route('login');
    }
    public function getValidateResetPage()
    {
        return view('validateResetPage');
    }
    public function validateResetCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        $user = User::where('password_reset_code', $request->input('code'))->first();
        if (!$user) {
            return redirect()->route('password.validateResetPage')->withErrors([
                'resetError' => 'Invalid reset code.'
            ]);
        }
        session()->flash('status', 'Reset code validated successfully! You can now set your new password.');
        session([
            'reset_email'=> $user->email,
            'reset_code'=> $request->input('code')            
        ]);
        return redirect()->route('password.reset');
    }

}
