import { Enemy } from "./Enemy";
import { RangedEnemy } from "./RangedEnemy";
import { HealerEnemy } from "./EnemyHealer";


function checkEnemyType(scene,spawnX,spawnY,row,enemyConfig){
    switch(enemyConfig.type){
        case 'standard':
            return new Enemy(scene,spawnX,spawnY,row,enemyConfig);
        case 'ranged':
            return new RangedEnemy(scene,spawnX,spawnY,row,enemyConfig);
        case 'healer':
            return new HealerEnemy(scene,spawnX,spawnY,row,enemyConfig);
        default:
            return false;
    }
}
export { checkEnemyType };