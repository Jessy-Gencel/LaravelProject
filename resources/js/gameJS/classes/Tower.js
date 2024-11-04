import Phaser from 'phaser';
import { Projectile } from './Projectile';
class Tower extends Phaser.Physics.Arcade.Sprite  {
    constructor(scene, x, y, sprite, attackSpeed, damage, range, rotation_angle,projectileSprite,projectileSpeed) {
        super(scene, x, y, sprite);
        this.attackSpeed = attackSpeed;
        this.damage = damage;
        this.range = range;
        this.rotation_angle = rotation_angle;
        this.target = null; 
        this.lastAttackTime = 0;
        this.projectiles = [];
        this.projectileSprite = projectileSprite;
        this.projectileSpeed = projectileSpeed
        this.timeSinceLastShot = 0;
        scene.physics.add.existing(this);
        this.setImmovable(true);
        scene.add.existing(this);
        this.setAngle(this.rotation_angle); 
        this.startShooting();
        this.scene.events.on('projectileOffScreen', this.handleProjectileOffScreen, this);
    }

    findTarget(enemies) {
        this.target = enemies.find(enemy => Phaser.Math.Distance.Between(this.sprite.x, this.sprite.y, enemy.x, enemy.y) <= this.range);
    }

    destroy() {
        this.sprite.destroy();
    }
    shoot() {
        console.log('were here')
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
                { x: 1, y: 0 } 
            );
            this.projectiles.push(projectile);
        }
    }
    update(delta, enemies) {
        this.projectiles.forEach(projectile => projectile.update());
    }
    destroy() {
        this.sprite.destroy();
        this.projectiles.forEach(projectile => projectile.destroy());
    }
    startShooting() {
        this.scene.time.addEvent({
            delay: 3000, 
            callback: () => {
                this.shoot();
                this.animateShooting();
            },
            loop: true
        });
    }
    handleProjectileOffScreen(projectile) {
        const index = this.projectiles.indexOf(projectile);
        if (index !== -1) {
            this.projectiles.splice(index, 1);
        }
    }
    animateShooting() {
        this.scene.tweens.add({
            targets: this,
            scaleX: 1.2,
            scaleY: 1.2,
            duration: 100,
            yoyo: true,
            onComplete: () => {
                this.setScale(1);
            }
        });
        this.scene.tweens.add({
            targets: this,
            x: this.x - 30,
            duration: 50,
            yoyo: true
        });
    }

}
export { Tower };
