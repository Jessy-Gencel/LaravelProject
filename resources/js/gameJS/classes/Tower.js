import Phaser from 'phaser';
import { Projectile } from './Projectile';
class Tower extends Phaser.Physics.Arcade.Sprite  {
    constructor(scene, x, y, sprite, hitpoints,attackSpeed, damage, range, rotation_angle,projectileSprite,projectileSpeed,row,col,scale_projectiles = 1) {
        console.log(attackSpeed)
        super(scene, x, y, sprite);
        this.remainingHitpoints = hitpoints;
        this.hitpoints = hitpoints;
        this.attackSpeed = attackSpeed;
        this.damage = damage;
        this.range = range;
        this.rotation_angle = rotation_angle;
        this.target = null; 
        this.projectileSprite = projectileSprite;
        this.projectileSpeed = projectileSpeed;
        this.actions = [];
        this.row = row;
        this.col = col;
        this.scale_projectiles = scale_projectiles;
    }

    findTarget(enemies) {
        this.target = enemies.find(enemy => Phaser.Math.Distance.Between(this.sprite.x, this.sprite.y, enemy.x, enemy.y) <= this.range);
    }
    updateTint() {
        const healthPercentage = this.remainingHitpoints / this.hitpoints;
        const tintAmount = Math.floor((1 - healthPercentage) * 255);
        this.setTint(Phaser.Display.Color.GetColor(255, 255 - tintAmount, 255 - tintAmount));
    }
    takeDamage(damage) {
        this.remainingHitpoints -= damage;
        this.updateTint();
        this.playDamageAnimation();
    }
    shoot() {
        if (this.target || this.range === null) {
            const projectile = new Projectile(
                this.scene,
                this.x,
                this.y,
                this.projectileSprite,
                this.projectileSpeed,
                this.damage,
                this.range,
                this.target,
                { x: 1, y: 0 }, 
                this.scale_projectiles
            );
            this.scene.projectileManager.addProjectile(projectile);
        }
    }
    startShooting() {
        this.actions.push(this.scene.time.addEvent({
            delay: this.attackSpeed, 
            callback: () => {
                this.shoot();
                this.animateShooting();
            },
            loop: true
        }));
    }
    destroy() {
        this.stopShooting();
        this.scene.placedTowers[this.row][this.col] = null;
        this.scene.gridCells[this.row][this.col] = { occupied: false };
        super.destroy();
    }
    stopShooting() {
        for (let action of this.actions) {
            action.remove();
        }
    }
    animateShooting() {
        this.actions.push(
        this.scene.tweens.add({
            targets: this,
            scaleX: 1.2,
            scaleY: 1.2,
            duration: 100,
            yoyo: true,
            onComplete: () => {
                this.setScale(1);
            }
        }));
        this.actions.push(
        this.scene.tweens.add({
            targets: this,
            x: this.x - 30,
            duration: 50,
            yoyo: true
        }));
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

}
export { Tower };
