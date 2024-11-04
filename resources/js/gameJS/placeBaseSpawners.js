import {Spawner} from './classes/EnemySpawner.js';
import { gridConfig } from './gridConfig.js';

function placeBaseSpawners(game,enemyConfigs,spawnRate){
    for (let row = 0; row < gridConfig.numRows; row++) {
        const x = game.scale.width - 50;
        const y = gridConfig.startOffsety + gridConfig.squareHeight/2 + row * gridConfig.squareHeight;
        const enemySpawner1 = new Spawner(game, x, y, enemyConfigs, spawnRate); 
            game.enemySpawners.push(enemySpawner1);
    }
}
export {placeBaseSpawners};