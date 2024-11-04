function updateProjectiles(game,delta){
    Object.keys(game.placedTowers).forEach((row) => {
        Object.keys(game.placedTowers[row]).forEach((col) => {
            const tower = game.placedTowers[row][col];
            if (tower) {
                tower.update(delta, null);
            }
        });
    })
}
export {updateProjectiles};