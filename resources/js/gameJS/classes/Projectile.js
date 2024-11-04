class Projectile extends Phaser.Physics.Arcade.Sprite {
    constructor(scene, x, y, projectile_sprite, projectile_speed, damage, range = null, target = null, direction = { x: 1, y: 0 }) {
        super(scene, x, y, projectile_sprite);
        this.speed = projectile_speed;
        this.damage = damage;
        this.range = range;
        this.target = target;
        this.direction = direction;
        this.startX = x;
        this.startY = y;
        this.distanceTraveled = 0;
        scene.physics.add.existing(this);
        if (!this.target) {
            this.setVelocity(this.speed * 200,0);
        }
        this.setAngle(90); // Set the initial rotation angle
        scene.add.existing(this);
    }

    update() {
        if (this.target) {
            const angle = Phaser.Math.Angle.Between(this.x, this.y, this.target.x, this.target.y);
            this.setVelocity(Math.cos(angle) * this.speed, Math.sin(angle) * this.speed);
        }
        if (this.range) {
            this.distanceTraveled = Phaser.Math.Distance.Between(this.startX, this.startY, this.x, this.y);
            if (this.distanceTraveled >= this.range) {
                this.destroy();
            }
        }
        this.checkIfOffScreen();
    }
    checkIfOffScreen() {
        if (this.body.position.x > this.scene.scale.width || this.body.position.y > this.scene.scale.height) {
            this.scene.events.emit('projectileOffScreen', this);
            this.destroy();
        }
    }

    destroy() {
        super.destroy();
    }
}
export { Projectile };
