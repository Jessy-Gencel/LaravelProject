@extends('layouts.gamePage')
@section('content')
    <div id="phaser-game" style="width: 100%; height: 100vh;"></div>
    <button id="authRouteTrigger" style="display: none;" onclick="window.location.href='{{ route('game.gameOverScreen') }}'">
        Game Over Screen
    </button>
@endsection
