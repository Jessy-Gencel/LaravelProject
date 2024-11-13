const HealerMixin = (superclass) => class extends superclass {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        this.healRange = enemyConfig.heal_range;
        this.healAmount = enemyConfig.heal_amount;
        this.healRate = enemyConfig.heal_rate;
        this.healingRangeCircle = scene.add.circle(this.x, this.y, this.healRange, 0x00ff00, 0.2); 
        this.healingRangeCircle.setStrokeStyle(2, 0x00ff00); 
        this.dies.push("healerDie");
        this.updates.push("healerUpdate");
        this.startHealing();
        this.type.push("healer");
    }

    healNearbyEnemies() {
        const enemies = this.scene.enemyManager.getAllEnemies();
        enemies.filter(enemy => {
            let distance = Phaser.Math.Distance.Between(this.x, this.y, enemy.x, enemy.y);
            return distance <= this.healRange && enemy !== this; 
        }).forEach(enemy => {
            enemy.remainingHealth = Math.min(enemy.health, enemy.remainingHealth + this.healAmount);
            for (let i = 0; i < 4; i++) {  
                const angle = Phaser.Math.FloatBetween(0, Math.PI * 2); 
                const distance = Phaser.Math.FloatBetween(5, 30); 
                const sparkleX = enemy.x + Math.cos(angle) * distance;
                const sparkleY = enemy.y + Math.sin(angle) * distance;
                const sparkle = this.scene.add.sprite(sparkleX, sparkleY, 'healEffect');
                sparkle.setScale(0.05);
                sparkle.setTint(0x00ff00);       
                this.scene.tweens.add({
                    targets: sparkle,
                    scale: { from: 0.05, to: 0.1 },  
                    alpha: { from: 1, to: 0 },     
                    duration: 300,                 
                    onComplete: () => sparkle.destroy() 
                });
            }
        });
    }

    startHealing() {
        const event = this.scene.time.addEvent({
            delay: this.healRate * 1000,
            callback: this.healNearbyEnemies,
            callbackScope: this,
            loop: true
        });
        this.actions["heal"] = event;
    }

    healerDie() {
        this.healingRangeCircle.destroy();
    }

    healerUpdate(time, delta) {
        this.healingRangeCircle.setPosition(this.x, this.y);
    }
};
export { HealerMixin };
