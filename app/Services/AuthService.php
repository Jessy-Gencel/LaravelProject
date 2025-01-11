<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function isAuthenticated()
    {
        return Auth::check();
    }

    public function isAdmin()
    {
        $user = Auth::user();
        return $user && $user->is_admin;
    }
}