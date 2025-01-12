
function makeScoreboard(game){
    game.scoreText = game.add.text(
        game.scale.width / 2,
        30,
        'Score: 0',
        {
            fontSize: '32px',
            color: '#ffffff',
            fontFamily: 'Arial',
            align: 'center'
        }
    ).setOrigin(0.5, 0);
    game.waveText = game.add.text(
        game.scale.width / 2,
        80,
        'Wave: 1',
        {
            fontSize: '32px',
            color: '#ffffff',
            fontFamily: 'Arial',
            align: 'center'
        }
    ).setOrigin(0.5, 0);
    game.events.on('addScore', (points) => {
        game.score += points;
        game.scoreText.setText('Score: ' + game.score);
    });
    game.events.on('nextWave', (wave) => {
        game.wave = wave;
        game.waveText.setText('Wave: ' + game.wave);
    });
}
export { makeScoreboard };
