@extends('layouts.pageWithHeaderAndFooter')

@section('content')
<div id="gameOverScreen" style="text-align: center; padding: 50px; background-color: #f4f4f9;">
    <h1 style="font-size: 3em; color: #4CAF50; font-family: 'Arial', sans-serif;">Game Over</h1>
    <div id="scoreDisplay" style="font-size: 2em; color: #333; margin-top: 20px;">
        <p>Your Score: <span id="score" style="font-weight: bold; font-size: 2.5em;">{{ session('gameScore', 0) }}</span></p>
    </div>

    <!-- Buttons for saving the score or going home -->
    <form action="{{ route('game.saveScore') }}" method="POST" style="display: inline;">
        @csrf
        <input id="scoreInput" type="hidden" name="score" value="0">
        <button type="submit" style="background-color: #2196F3; color: white; padding: 15px 30px; font-size: 1.5em; border: none; cursor: pointer; margin-top: 30px; margin-left: 20px;">
            Go home
        </button>
    </form>
</div>
<script>
    window.onload = function() {
        console.log(localStorage.getItem('score'));
        const score = localStorage.getItem('score') || 0;  // Default to 0 if score is not found
        document.getElementById('score').textContent = score;  // Display the score in the designated span
        document.getElementById('scoreInput').value = score;  // Set the score in the hidden input field
    };
        // Function to restart the game or do something else when "Play Again" is clicked
    function restartGame() {
        localStorage.removeItem('score');  // Optionally remove the score from localStorage
            
    }
</script>
@endsection



