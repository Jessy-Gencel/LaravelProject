import { Projectile } from '../Projectile.js';
class Enemy extends Phaser.Physics.Arcade.Sprite {
    constructor(scene, x, y, row, enemyConfig) {
        console.log(enemyConfig);
        super(scene, x, y,enemyConfig.name);
        this.name = enemyConfig.name;
        this.row = row;
        this.remainingHealth = enemyConfig.health;
        this.health = enemyConfig.health;
        this.speed = enemyConfig.speed;
        this.damage = enemyConfig.damage;
        this.score = enemyConfig.score;
        this.sprite = enemyConfig.sprite;
        this.sound = enemyConfig.sound;
        this.actions = [];
        this.isEngaged = false;
    }
    takeDamage(amount) {
        this.remainingHealth -= amount;
        this.updateTint();
        this.playDamageAnimation();
    }
    updateTint() {
        const healthPercentage = this.remainingHealth / this.health;
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
