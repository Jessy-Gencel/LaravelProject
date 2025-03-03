import { Projectile } from '../Projectile.js';
import { gameOverScreen,setGameOverRoute,gameWon } from '../../gameOverScreen.js';
class Enemy extends Phaser.Physics.Arcade.Sprite {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y,enemyConfig.name);
        console.log(enemyConfig);
        this.name = enemyConfig.name;
        this.type = [];
        this.row = row;
        this.remainingHealth = enemyConfig.health;
        this.health = enemyConfig.health;
        this.speed = enemyConfig.speed;
        this.damage = enemyConfig.damage;
        this.score = enemyConfig.score;
        this.sprite = enemyConfig.sprite;
        this.sound = enemyConfig.sound;
        this.attackSpeed = enemyConfig.attack_speed;
        this.actions = {};
        this.updates = [];
        this.dies = [];
        this.isEngaged = false;
        this.takeNoStraightDamage = false;
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
    baseDie(addScore = true) {
        if (addScore) {
            this.scene.events.emit('addScore', this.score);
        }
        if (this.name == 'juggernaut'){
            setGameOverRoute(this.scene.score);
            gameWon();
        }
        for (const key in this.actions) {
            if (this.actions.hasOwnProperty(key)) {
                this.actions[key].remove();
            }
        }
        this.playDeathAnimation();
        this.destroy();
    }
    baseUpdate() {
        if (this.x < 0) {
            console.log()
            setGameOverRoute(this.scene.score);
            gameOverScreen(this.scene);
            this.die(false); 
        }
    }
}
export { Enemy };
