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
    public function gameOverScreen()
    {
        return view('game/gameOverScreen');
    }
    public function saveScore()
    {
        $score = (int) request('score');
        if ($score > 15000) {
            return response()->json(['error' => "Ah Look here, someone thought using f12 would be a good idea. Nice try! But you're banned!"]);	
        }
        $user = auth()->user();
        if ($user->leaderboard->highscore < $score) {
            $user->leaderboard->highscore = $score;
        }
        $user->leaderboard->save();
        return redirect()->route('home');
    }
    
    
}
