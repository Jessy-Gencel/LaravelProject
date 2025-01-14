<?php

namespace App\Http\Controllers\GameLogic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tower;
use App\Models\Enemy;
use Illuminate\Support\Facades\Log;
use App\Models\Achievement;


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

        $milestones = [
            2000 => 'Alien Guardrail',
            5000 => 'Alien Bastion',
            10000 => 'Juggernaut Slayer',
        ];
    
        foreach ($milestones as $threshold => $badgeName) {
            if ($score >= $threshold) {
                $badge = Achievement::where('name', $badgeName)->first();
                if ($badge && !$user->achievements->contains($badge->id)) {
                    $user->achievements()->attach($badge->id, [
                        'awarded_at' => now(),
                    ]);
                }
            }
        }
        return redirect()->route('home');
    }
    
    
}
