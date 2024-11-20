<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = Leaderboard::with('user')
            ->orderByDesc('highscore')
            ->take(10)
            ->get();
        return view('leaderboard.index', compact('leaderboard'));
    }
    public function updateHighscore(Request $request)
    {
        $request->validate([
            'highscore' => 'required|integer|min:0',
        ]);

        $leaderboard = Leaderboard::firstOrCreate(
            ['user_id' => auth()->id()],
            ['highscore' => 0]
        );
        if ($request->highscore > $leaderboard->highscore) {
            $leaderboard->update(['highscore' => $request->highscore]);
        }

        return redirect()->route('leaderboard.index')
        ->with('success', 'Highscore updated successfully!');
    }
}
