import { gridConfig } from '../gridConfig.js';
import { Spawner } from './EnemySpawner.js';

class EnemyManager {
    constructor(scene) {
        this.scene = scene; 
        this.spawners = [];
        this.enemies = this.scene.physics.add.group();
        this.rangedEnemies = this.scene.physics.add.group();
    }

    addEnemy(enemy) {
        if (enemy.type == 'ranged') {
            this.rangedEnemies.add(enemy);
        } else {
            this.enemies.add(enemy);
        }
        enemy.setOrigin(0.5, 0.5);
        enemy.setAngle(90);
        enemy.setScale(0.5);
        enemy.setVelocityX(-enemy.speed * 50);
        this.scene.add.existing(enemy);
        this.scene.physics.add.existing(enemy);
    }
    interuptRangedEnemies(){
        this.rangedEnemies.children.each(enemy => {
            if (enemy.isFiring){
                enemy.interruptShooting();
            }
        });
    }
    getAllEnemies() {
        const enemies = [
            ...this.enemies.getChildren(),
            ...this.rangedEnemies.getChildren()
        ]; 
        return enemies;
    }

    updateEnemies(time, delta) {
        this.enemies.children.each(enemy => {
            if (enemy.active) {
                enemy.combinedUpdate(time, delta); 
            }
        });
    }
    updateRangedEnemies(time, delta) {
        this.rangedEnemies.children.each(enemy => {
            if (enemy.active) {
                enemy.combinedUpdate(); 
            }
        });
    }
    startDamageOverTime(enemy, tower) {
        if (enemy.type == "teleporter"){
            if (enemy.justTeleported){
                enemy.justTeleported = false;
                return;
            }
        }
        if (!enemy.isEngaged){
            console.log("starting damage over time");
            enemy.isEngaged = true;
            enemy.setVelocityX(0);
            const damageInterval = enemy.attackSpeed * 1000;
            const event = this.scene.time.addEvent({
                delay: damageInterval,       
                callback: () => {
                    console.log("starting back up");
                    console.log(tower.active, enemy.active);
                    console.log(enemy);
                    if (tower.active && enemy.active) {
                        if (enemy.type == "healer"){
                            return;
                        } 
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
            });
            enemy.actions["damage"] = event;
        }
    }
    stopDamageOverTime(enemy) {
        if (enemy.actions["damage"]){ 
            enemy.actions["damage"].remove();
            delete enemy.actions["damage"];
            enemy.isDamaging = false;   
        }
        if (enemy.active){
            enemy.setVelocityX(-enemy.speed * 50);
            enemy.isEngaged = false;
            console.log("shutting down");
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
