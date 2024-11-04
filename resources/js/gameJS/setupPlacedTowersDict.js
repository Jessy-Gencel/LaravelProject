import { gridConfig } from './gridConfig.js';
function setupPlacedTowersDict(game) {
    for (let row = 0; row < gridConfig.numRows; row++) {
        game.placedTowers[row] = {}; 
        for (let col = 0; col < gridConfig.numCols; col++) {
            game.placedTowers[row][col] = null; 
        }
    }
}
export { setupPlacedTowersDict };	