function gameOverScreen(){
    const button = document.getElementById('authRouteTrigger');
    if (button) {
        button.click();
    }

}
function gameWon() {
    const button = document.getElementById('gameWonTrigger');
    if (button) {
        button.click();
    }
}
function setGameOverRoute(score) {
    console.log(score);
    localStorage.setItem('score', score);
}

export { gameOverScreen, setGameOverRoute,gameWon };