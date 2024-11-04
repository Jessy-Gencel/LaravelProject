class Enemy extends Phaser.Physics.Arcade.Sprite {
    constructor(scene, x, y, enemyConfig) {
        console.log(enemyConfig);
        super(scene, x, y, enemyConfig.name);
        this.scene = scene;
        this.health = enemyConfig.health;
        this.speed = enemyConfig.speed;
        this.damage = enemyConfig.damage;
        this.score = enemyConfig.score;
        this.sprite = enemyConfig.sprite;
        this.sound = enemyConfig.sound;
        this.projectileSprite = enemyConfig.projectile_sprite;
        this.projectileSound = enemyConfig.projectile_sound;
        this.projectileSpeed = enemyConfig.projectile_speed;
    }
    takeDamage(amount) {
        this.health -= amount;
        this.updateTint();
        this.playDamageAnimation();
        if (this.health <= 0) {
            this.playDeathAnimation();
            this.die();
        }
    }
    updateTint() {
        const healthPercentage = this.health / 100;
        const tintAmount = Math.floor((1 - healthPercentage) * 255);
        this.setTint(Phaser.Display.Color.GetColor(255, 255 - tintAmount, 255 - tintAmount));
    }
    playDamageAnimation() {
        this.scene.tweens.add({
            targets: this,
            alpha: { from: 1, to: 0.5 },
            ease: 'Cubic.easeOut',
            duration: 100,
            yoyo: true,
            onComplete: () => {
                this.setAlpha(1);
            }
        });
    }
    playDeathAnimation() {
        this.scene.tweens.add({
            targets: this,
            alpha: { from: 1, to: 0 },
            scale: { from: 1, to: 0 },
            ease: 'Cubic.easeIn',
            duration: 500,
        });
    }
    die() {
        this.scene.playerCurrency += this.reward;
        this.destroy();
    }
    update() {
        if (this.x < 0) {
            this.destroy(); 
        }
    }
}
export { Enemy };
