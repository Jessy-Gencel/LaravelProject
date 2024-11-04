import { Enemy } from './Enemy.js';
class Spawner {
    constructor(scene, x, y, enemyConfigList) {
        this.scene = scene;
        this.spawnX = x;
        this.spawnY = y;
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
    spawnEnemy() {
        const enemyConfig = Phaser.Utils.Array.GetRandom(this.enemyConfigList);
        const enemy = new Enemy(this.scene, this.spawnX, this.spawnY, enemyConfig);
        this.scene.enemyManager.addEnemy(enemy);
    }
}
export { Spawner };
