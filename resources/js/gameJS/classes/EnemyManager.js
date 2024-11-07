import { gridConfig } from '../gridConfig.js';
import { Spawner } from './EnemySpawner.js';
import { RangedEnemy } from './enemies/RangedEnemy.js';
class EnemyManager {
    constructor(scene) {
        this.scene = scene; 
        this.spawners = [];
        this.enemies = this.scene.physics.add.group();
        this.rangedEnemies = this.scene.physics.add.group();
    }

    addEnemy(enemy) {
        console.log(enemy);
        if (enemy instanceof RangedEnemy) {
            this.rangedEnemies.add(enemy);
        } else {
            console.log("test");
            this.enemies.add(enemy);
            console.log(this.enemies);
        }
        console.log("test");
        enemy.setOrigin(0.5, 0.5);
        enemy.setAngle(90);
        enemy.setScale(0.5);
        enemy.setVelocityX(-enemy.speed * 50);
        this.scene.add.existing(enemy);
        this.scene.physics.add.existing(enemy);
        console.log(this.enemies);
    }
    interuptRangedEnemies(){
        this.rangedEnemies.children.each(enemy => {
            if (enemy.isFiring){
                enemy.interruptShooting();
            }
        });
    }

    updateEnemies(time, delta) {
        this.enemyGroup.children.each(enemy => {
            if (enemy.active) {
                enemy.update(time, delta); 
            }
        });
    }
    updateRangedEnemies(time, delta) {
        this.rangedEnemies.children.each(enemy => {
            if (enemy.active) {
                enemy.checkEnemyRange(); 
            }
        });
    }
    startDamageOverTime(enemy, tower) {
        if (!enemy.isEngaged){
            enemy.isEngaged = true;
            enemy.setVelocityX(0);
            const damageInterval = 1000;
            enemy.actions.push(this.scene.time.addEvent({
                delay: damageInterval,       
                callback: () => {
                    console.log(tower.active, enemy.active);
                    if (tower.active && enemy.active) { 
                        tower.takeDamage(enemy.damage);
                        if (tower.remainingHitpoints <= 0) {
                            tower.destroy();       
                            this.stopDamageOverTime(enemy); 
                        }
                    } else {
                        this.stopDamageOverTime(enemy);
                    }
                },
                loop: true                    
            }));
        }
    }
    stopDamageOverTime(enemy) {
        if (enemy.active){
            console.log(enemy);
            enemy.setVelocityX(-enemy.speed * 50);
            enemy.isEngaged = false;
            if (enemy.actions.length > 0){ 
                enemy.actions.forEach(action => {
                    action.remove();
                });
                console.log(enemy.actions);
                enemy.isDamaging = false;   
            }
        }
    }    
    resetEnemies() {
        this.enemyGroup.clear(true, true); 
    }
    placeBaseSpawners(){
        for (let row = 0; row < gridConfig.numRows; row++) {
            const x = this.scene.scale.width - 50;
            const y = gridConfig.startOffsety + gridConfig.squareHeight/2 + row * gridConfig.squareHeight;
            const enemySpawner1 = new Spawner(this.scene, x, y,row,this.scene.enemies); 
            this.spawners.push(enemySpawner1);
        }
    }
}
export {EnemyManager};
