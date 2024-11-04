import {gridConfig} from './gridConfig.js';

function setBackground(game) {
    game.background = game.add.tileSprite(0, 0, window.innerWidth, window.innerHeight, 'background');
    game.background.setOrigin(0, 0);
}
function makeGrid(game) {
    const graphics = game.add.graphics(); 
    graphics.lineStyle(2, 0x808080, 1);
    for (let row = 0; row < gridConfig.numRows; row++) {
        for (let col = 0; col < gridConfig.numCols; col++) {
            const x = col * gridConfig.squareWidth + gridConfig.startOffsetx;
            const y = row * gridConfig.squareHeight + gridConfig.startOffsety;
            graphics.strokeRect(x, y, gridConfig.squareWidth, gridConfig.squareHeight);
        }
    }
}
export {setBackground, makeGrid};