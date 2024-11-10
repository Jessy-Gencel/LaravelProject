import { Tower } from "./classes/Tower";
import { gridConfig } from "./gridConfig";
function setupUIHandlers(game) {
    game.input.on('pointerdown', (pointer) => {
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;
        const widthMultiplier = screenWidth / 1920;
        const heightMultiplier = screenHeight / 1080;
        if (!game.selectedTower) return;
        game.draggingTower = game.add.sprite(pointer.x, pointer.y, game.selectedTower.name);
        game.draggingTower.setAngle(game.selectedTower.rotation_angle);
        game.draggingTower.setScale(1.29 * widthMultiplier, 1.5 * heightMultiplier);
    });

    game.input.on('pointermove', (pointer) => {
        if (game.draggingTower) {
            game.draggingTower.x = pointer.x;
            game.draggingTower.y = pointer.y;
        }
    });

    game.input.on('pointerup', (pointer) => {
        if (game.draggingTower) {
            const col = Math.floor((pointer.x - gridConfig.startOffsetx) / gridConfig.squareWidth);
            const row = Math.floor((pointer.y - gridConfig.startOffsety) / gridConfig.squareHeight);
            if (col >= 0 && col < gridConfig.numCols && row >= 0 && row < gridConfig.numRows) {
                const x = gridConfig.startOffsetx + col * gridConfig.squareWidth + gridConfig.squareWidth / 2;
                const y = gridConfig.startOffsety + row * gridConfig.squareHeight + gridConfig.squareHeight / 2;
                if (!game.gridCells[row][col].occupied && game.currency >= game.selectedTower.price) {
                    const newTower = new Tower(
                        game,
                        x,
                        y,
                        game.selectedTower.name,
                        game.selectedTower.hitpoints,
                        game.selectedTower.attackSpeed,
                        game.selectedTower.damage,
                        game.selectedTower.range,
                        game.selectedTower.rotation_angle,
                        game.selectedTower.name + '_projectile',
                        game.selectedTower.projectileSpeed,
                        row,
                        col,
                    );
                    game.towerManager.addTower(newTower);
                    game.placedTowers[row][col] = newTower;
                    game.gridCells[row][col] = { occupied: true };
                    game.currency -= game.selectedTower.price;
                    game.selectedTower = null;
                    game.draggingTower.destroy();
                    game.draggingTower = null;
                    game.enemyManager.interuptRangedEnemies()
                } else {
                    game.draggingTower.destroy();
                    game.draggingTower = null;
                }
            } else {
                game.draggingTower.destroy();
                game.selectedTower = null;
                game.draggingTower = null;
            }
            game.uiContainer.list.forEach(child => {
                if (child.fillColor === 0x777777) {
                    child.setFillStyle(0x555555);
                }
            });
        }
    });
}
function updateCurrencyText(game) {
    game.currencyText.setText(`Currency: ${game.currency}`);
}

export {setupUIHandlers, updateCurrencyText};