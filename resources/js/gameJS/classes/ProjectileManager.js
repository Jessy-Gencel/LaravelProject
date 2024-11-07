class ProjectileManager {
    constructor(scene) {
        this.scene = scene;
        this.projectiles =  this.scene.physics.add.group();
        this.enemyProjectiles = this.scene.physics.add.group();
        this.scene.events.on('projectileOffScreen', this.handleProjectileOffScreen, this);
    }

    addProjectile(projectile) {
        this.projectiles.add(projectile);
        projectile.setAngle(90);
        if (!projectile.target){
            this.scene.physics.add.existing(projectile);
            this.scene.add.existing(projectile);
            projectile.setVelocity(projectile.speed * 200,0);
        }
    }
    addEnemyProjectile(projectile) {
        projectile.setAngle(-90);
        this.enemyProjectiles.add(projectile);
        if (!projectile.target){
            this.scene.physics.add.existing(projectile);
            this.scene.add.existing(projectile);
            projectile.setVelocity(-projectile.speed * 200,0);
        }
    }

    setupCollision(enemies) {
        this.scene.physics.add.overlap(this.projectiles, enemies, (projectile, enemy) => {
            this.handleCollision(projectile, enemy);
        });
    }

    handleCollision(projectile, enemy) {
        enemy.takeDamage(projectile.damage); 
        if (enemy.remainingHealth <= 0) {
            if (enemy.actions.length > 0) {
                for (let i = 0; i < enemy.actions.length; i++) {
                    enemy.actions[i].remove();
                }
            }
            enemy.playDeathAnimation();
            enemy.die();
        }
        projectile.destroy(); 
    }
    handleEnemyProjectileCollision(projectile, tower) {
        tower.takeDamage(projectile.damage);
        if (tower.remainingHitpoints <= 0) {
            tower.destroy();
        }
        projectile.destroy();
    }
    update(delta) {
        this.projectiles.getChildren().forEach(projectile => {
            projectile.update();
        });
        
    }
    handleProjectileOffScreen(projectile) {
        this.projectiles.remove(projectile, true, true);
    }

    cleanup() {
        this.projectiles.clear(true, true); 
    }
}
export { ProjectileManager };
