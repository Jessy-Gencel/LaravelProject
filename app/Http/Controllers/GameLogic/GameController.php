<?php

namespace App\Http\Controllers\GameLogic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game/index');
    }
    
    
}
