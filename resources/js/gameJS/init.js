import { ProjectileManager } from './classes/ProjectileManager.js';
import { EnemyManager } from './classes/EnemyManager.js';
import { TowerManager } from './classes/TowerManager.js';
import { gridConfig } from './gridConfig.js';
import {setupUIHandlers,updateCurrencyText} from './setupUIHandlers.js';
import { setupOreMines } from './setupOreMines.js';
import { setupPlacedTowersDict } from './setupPlacedTowersDict.js';
import { setBackground,makeGrid } from './gameBoardSetup.js';
import { makeScoreboard } from './makeScoreboard.js';

function initialize(game){
    game.projectileManager = new ProjectileManager(game);
    game.enemyManager = new EnemyManager(game);
    game.towerManager = new TowerManager(game);
    game.sound.pauseOnBlur = false;
    setBackground(game);
    makeGrid(game); 
    game.gridCells = Array.from({ length: gridConfig.numRows }, () => Array(gridConfig.numCols).fill({ occupied: false }));
    setupUIHandlers(game);
    setupOreMines(game);
    setupPlacedTowersDict(game);
    makeScoreboard(game);
}
export {initialize};