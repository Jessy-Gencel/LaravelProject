import { Enemy } from "./Enemy";
import { Projectile } from "../Projectile";

class RangedEnemy extends Enemy{
    constructor(scene, x, y, row, enemyConfig){
        super(scene, x, y, row, enemyConfig);
        this.range = enemyConfig.range;
        this.fireRate = enemyConfig.fire_rate;
        this.projectileSprite = enemyConfig.projectile_sprite;
        this.projectileSound = enemyConfig.projectile_sound;
        this.projectileSpeed = enemyConfig.projectile_speed;
        this.predictedHealth = null;
        this.target = null;
        this.isFiring = false;
    }
    shoot(){
        const projectile = new Projectile(
            this.scene,
            this.x,
            this.y,
            `${this.name}_projectile`,
            this.projectileSpeed,
            this.damage,
            { x: -1, y: 0 }
        );
        this.scene.projectileManager.addEnemyProjectile(projectile);
    }
    startShooting() {
        this.isFiring = true;
        this.setVelocityX(0);
        this.actions.push(this.scene.time.addEvent({
            delay: 3000, 
            callback: () => {
                this.shoot();
                this.checkEnemyRange(true);
            },
            loop: true
        }));
    }
    checkEnemyRange(shot = false) {
        if (this.target){
            if (shot){
                this.predictedHealth = this.target.remainingHitpoints - this.damage;
                if (this.predictedHealth <= 0){
                    this.interruptShooting();
                    return false;
                }
            }
            return true;
        }
        const row = this.row; 
        const towersInRow = this.scene.placedTowers[row];
        if (towersInRow) {
            for (let col = Object.keys(towersInRow).length - 1; col >= 0; col--) {
                const tower = towersInRow[col];
                if (!tower) {
                    continue;
                }
                const distance = Math.abs(this.x - tower.x);
                console.log(this.range)
                if (distance <= this.range) {
                    this.target = tower;
                    this.startShooting();
                    return true;
                }
            }
        }
        return false;
    }
    interruptShooting() {
        this.target = null;
        this.isFiring = false;
        this.predictedHealth = null;
        this.setVelocityX(-this.speed * 50);
        this.actions.forEach(action => {
            action.remove();
        });
        return false;
    }

}
export { RangedEnemy };