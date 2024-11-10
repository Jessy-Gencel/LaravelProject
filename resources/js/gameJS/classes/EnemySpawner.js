import { Enemy } from './enemies/Enemy.js';
import { checkEnemyType } from './enemies/EnemyCheck.js';
class Spawner {
    constructor(scene, x, y,row, enemyConfigList) {
        this.scene = scene;
        this.spawnX = x;
        this.spawnY = y;
        this.row = row;
        this.enemyConfigList = enemyConfigList;
        this.spawnEvent = null; 
    }

    startSpawning(spawnInterval) {
        this.spawnEvent = this.scene.time.addEvent({
            delay: spawnInterval,
            callback: this.spawnEnemy,
            callbackScope: this,
            loop: true,
        });
    }
    stopSpawning() {
        if (this.spawnEvent) {
            this.spawnEvent.remove();
            this.spawnEvent = null;
        }
    }
    spawnEnemyRandom() {
        const enemyConfigKeys = Object.keys(this.enemyConfigList);
        const randomKey = Phaser.Utils.Array.GetRandom(enemyConfigKeys);
        const enemyConfig = this.enemyConfigList[randomKey];
        const enemy = checkEnemyType(this.scene, this.spawnX, this.spawnY, this.row, enemyConfig);
        this.scene.enemyManager.addEnemy(enemy);
    }
    spawnEnemy(enemyType){
        const enemyConfig = this.enemyConfigList[enemyType];
        const enemy = checkEnemyType(this.scene, this.spawnX, this.spawnY, this.row, enemyConfig);
        this.scene.enemyManager.addEnemy(enemy);
    }
}
export { Spawner };
