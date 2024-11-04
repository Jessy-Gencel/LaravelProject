<?php

namespace App\Http\Controllers\GameLogic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tower;
use App\Models\Enemy;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function index()
    {
        return view('game/index');
    }
    public function getTowers()
    {
        $towers = Tower::all();
        Log::info($towers);
        return response()->json($towers);
    }
    public function getEnemies()
    {
        $enemies = Enemy::all();
        Log::info($enemies);
        return response()->json($enemies);
    }
    
    
}
