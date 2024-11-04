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
        this.setOrigin(0.5, 0.5);
        this.setAngle(90);
        this.setScale(0.5);
        scene.add.existing(this);
        scene.physics.add.existing(this);
        this.setVelocityX(-this.speed * 40);
    }
    takeDamage(amount) {
        this.health -= amount;
        if (this.health <= 0) {
            this.die();
        }
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
