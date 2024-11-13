import { Enemy } from "./Enemy";
import { RangedEnemyMixin } from "./RangedEnemy";
import { HealerMixin } from "./EnemyHealer";
import { combineMethods } from "../../util/MixinHelper.js";
import { BarrierMixin } from "./BarrierEnemy";
import { SpawnerMixin } from "./BreederEnemy";
import { TeleporterMixin } from "./TeleporterEnemy.js";
import { CloakedEnemyMixin } from "./CloakedEnemy.js";
import { JuggernautBossMixin } from "./JuggernautBoss.js";

function checkEnemyType(scene,spawnX,spawnY,row,enemyConfig){
    let EnemyClass = Enemy;
    switch(enemyConfig.type){
        case 'standard':
            break;
        case 'ranged':
            EnemyClass = RangedEnemyMixin(Enemy);
            break;
        case 'healer':
            EnemyClass = HealerMixin(Enemy);
            break;
        case 'barrier':
            EnemyClass = BarrierMixin(Enemy);
            break;
        case 'spawner':
            EnemyClass = SpawnerMixin(Enemy);
            break;
        case 'teleporter':
            EnemyClass = TeleporterMixin(Enemy);
            break;
        case 'inquisitor':
            EnemyClass = TeleporterMixin(BarrierMixin(Enemy));
            break;
        case 'cloaked':
            EnemyClass = CloakedEnemyMixin(Enemy);
            break;
        case 'stalker':
            EnemyClass = CloakedEnemyMixin(RangedEnemyMixin(Enemy));
            break; 
        case 'juggernaut':
            EnemyClass = JuggernautBossMixin(BarrierMixin(CloakedEnemyMixin(Enemy)));
            break;
        default:
            return false;
    }
    const enemy = new EnemyClass(scene, spawnX, spawnY, row, enemyConfig);
    combineMethods(enemy, enemy.updates, enemy.dies);
    return enemy;
}
export { checkEnemyType };