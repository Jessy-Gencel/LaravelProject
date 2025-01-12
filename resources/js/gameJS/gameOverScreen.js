async function gameOverScreen(game){
    try{
        const button = document.getElementById('authRouteTrigger');
        if (button) {
            button.click();
        }
    }catch(error){
        console.error('Error fetching towers:', error);
        return [];
    }
}
function setGameOverRoute(score) {
    console.log('Game Over! Score:', score);
    localStorage.setItem('score', score);
}
export { gameOverScreen, setGameOverRoute };