class ProjectileManager {
    constructor(scene,projectiles) {
        this.scene = scene;
        this.projectiles = projectiles;
        this.scene.events.on('projectileOffScreen', this.handleProjectileOffScreen, this);
    }

    addProjectile(projectile) {
        this.projectiles.add(projectile);
        if (!projectile.target){
            this.scene.physics.add.existing(projectile);
            this.scene.add.existing(projectile);
            projectile.setVelocity(projectile.speed * 200,0);
        }
    }

    setupCollision(enemies) {
        this.scene.physics.add.overlap(this.projectiles, enemies, (projectile, enemy) => {
            this.handleCollision(projectile, enemy);
        });
    }

    handleCollision(projectile, enemy) {
        enemy.takeDamage(projectile.damage); 
        console.log(`Hit! Enemy health: ${enemy.health}`);
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
