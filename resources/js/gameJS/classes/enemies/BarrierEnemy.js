const BarrierMixin = (superclass) => class extends superclass {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        this.barrierHealth = enemyConfig.barrier_health; 
        this.maxBarrierHealth = enemyConfig.barrier_health; 
        this.regenRate = enemyConfig.barrier_regen;  
        this.regenDelay = enemyConfig.barrier_regen_cooldown;
        this.cooldown = enemyConfig.barrier_cooldown;
        this.barrierRadius = enemyConfig.barrier_radius;
        this.cooldownElapsed = 0; 
        this.dies.push("barrierDie");
        this.updates.push("barrierUpdate");
        this.isRegenerating = false;
        this.barrierBroken = false;
        this.barrierCircle = scene.add.circle(this.x, this.y, this.barrierRadius, 0x000000, 0.2); 
        this.barrierCircle.setStrokeStyle(2, 0x0000ff); 
        this.type.push("barrier");
        this.takeNoStraightDamage = true;
    }

    barrierUpdate(time, delta) {
        if (this.barrierBroken) {
            return;
        }
        this.updateVisuals();
        this.cooldownElapsed += delta;
        if (this.cooldownElapsed > this.cooldown * 1000 && !this.isRegenerating) {
            this.startRegenerating();
            this.isRegenerating = true;
        }
    }
    regenerateHealth() {
        if (this.barrierBroken) {
            return;
        }
        this.barrierHealth = Math.min(this.barrierHealth + this.regenRate, this.maxBarrierHealth);
        let healthPercentage = this.barrierHealth / this.maxBarrierHealth;
        let colorShade = Phaser.Display.Color.Interpolate.ColorWithColor(
            new Phaser.Display.Color(255, 0, 0),
            new Phaser.Display.Color(0, 0, 255), 
            100,
            healthPercentage * 100
        );
        let color = Phaser.Display.Color.GetColor(colorShade.r, colorShade.g, colorShade.b);
        this.barrierCircle.setStrokeStyle(2, color);
    }
    startRegenerating() {
        const event = this.scene.time.addEvent({
            delay: this.regenDelay * 1000,
            callback: this.regenerateHealth,
            callbackScope: this,
            loop: true
        });
        this.actions["regenerate"] = event;
    }
    updateVisuals() {
        this.barrierCircle.setPosition(this.x, this.y);
    }
    
    flickerOnHit() {
        let healthPercentage = this.barrierHealth / this.maxBarrierHealth;
        let colorShade = Phaser.Display.Color.Interpolate.ColorWithColor(
            new Phaser.Display.Color(255, 0, 0),
            new Phaser.Display.Color(0, 0, 255), 
            100,
            healthPercentage * 100
        );
        let color = Phaser.Display.Color.GetColor(colorShade.r, colorShade.g, colorShade.b);
        
        this.scene.tweens.add({
            targets: this.barrierCircle,
            duration: 50,
            yoyo: true,
            ease: 'Linear',
            tint: 0xffffff,
            onStart: () => {
                this.barrierCircle.setStrokeStyle(2, 0xffffff);
            },
            onComplete: () => {
                this.barrierCircle.setStrokeStyle(2, color);
            }
        });
    }
    restoreBarrier(){
        this.takeNoStraightDamage = true;
        this.barrierCircle = this.scene.add.circle(this.x, this.y, this.barrierRadius, 0x000000, 0.2); 
        this.barrierCircle.setStrokeStyle(2, 0x0000ff); 
        this.barrierBroken = false;
        this.barrierHealth = this.maxBarrierHealth;
        this.isRegenerating = false;
        this.cooldownElapsed = 0;
    }
    
    takeBarrierDamage(amount) {
        console.log(this.barrierHealth);
        this.isRegenerating = false;
        this.barrierHealth -= amount;
        this.flickerOnHit();
        this.cooldownElapsed = 0;
        if (this.barrierHealth <= 0) {
            this.barrierBroken = true;
            this.barrierDie();
        }
        if (this.actions["regenerate"]) {
            this.actions["regenerate"].remove();
        }
    }
    barrierDie() {
        this.barrierCircle.destroy();
        this.takeNoStraightDamage = false;
    }
};

export { BarrierMixin };
