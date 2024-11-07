import { Enemy } from "./Enemy";
class HealerEnemy extends Enemy {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        console.log(enemyConfig);
        this.range = enemyConfig.range;
        this.healAmount = enemyConfig.heal_amount;
        this.healingRangeCircle = scene.add.circle(this.x, this.y, this.range, 0x00ff00, 0.2); 
        this.healingRangeCircle.setStrokeStyle(2, 0x00ff00); 
    }

    healNearbyEnemies() {
        let enemies = this.scene.getAllEnemies();

        enemies.forEach(enemy => {
            let xDistance = Phaser.Math.Distance.Between(this.x, this.y, enemy.x, this.y);
            let yDistance = Math.abs(enemy.y - this.y);

            if (xDistance <= this.range && yDistance <= 146) {
                enemy.health = Math.min(enemy.maxHealth, enemy.health + this.healAmount);
                this.scene.add.particles('healingParticle').emitParticleAt(enemy.x, enemy.y, 1);
            }
        });

        this.healingRangeCircle.setPosition(this.x, this.y);
    }
}
export { HealerEnemy };
