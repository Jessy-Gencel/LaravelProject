import { Enemy } from './Enemy.js';
class Spawner {
    constructor(scene, x, y, enemyConfigList, spawnInterval) {
        this.scene = scene;
        this.spawnX = x;
        this.spawnY = y;
        this.enemyConfigList = enemyConfigList;
        this.spawnInterval = spawnInterval;
        this.spawnEvent = null; 
    }

    startSpawning() {
        this.spawnEvent = this.scene.time.addEvent({
            delay: this.spawnInterval,
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
        console.log(this.scene);
        const enemyConfig = Phaser.Utils.Array.GetRandom(this.enemyConfigList);
        const enemy = new Enemy(this.scene, this.spawnX, this.spawnY, enemyConfig);
        this.scene.activeEnemies.push(enemy);
        this.stopSpawning();
    }
}
export { Spawner };
