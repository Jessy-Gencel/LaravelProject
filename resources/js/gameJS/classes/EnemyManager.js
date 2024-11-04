import { gridConfig } from '../gridConfig.js';
import { Spawner } from './EnemySpawner.js';
class EnemyManager {
    constructor(scene) {
        this.scene = scene; 
        this.spawners = [];
        this.activeEnemies = this.scene.physics.add.group();
    }

    addEnemy(enemy) {
        this.activeEnemies.add(enemy);
        enemy.setOrigin(0.5, 0.5);
        enemy.setAngle(90);
        enemy.setScale(0.5);
        enemy.setVelocityX(-enemy.speed * 50);
        this.scene.add.existing(enemy);
        this.scene.physics.add.existing(enemy);
        console.log(this.activeEnemies);
    }
    updateEnemies(time, delta) {
        this.enemyGroup.children.each(enemy => {
            if (enemy.active) {
                enemy.update(time, delta); 
            }
        });
    }
    resetEnemies() {
        this.enemyGroup.clear(true, true); 
    }
    placeBaseSpawners(){
        for (let row = 0; row < gridConfig.numRows; row++) {
            const x = this.scene.scale.width - 50;
            const y = gridConfig.startOffsety + gridConfig.squareHeight/2 + row * gridConfig.squareHeight;
            const enemySpawner1 = new Spawner(this.scene, x, y, this.scene.enemies.slice(0, 1)); 
            this.spawners.push(enemySpawner1);
        }
    }
}
export {EnemyManager};
