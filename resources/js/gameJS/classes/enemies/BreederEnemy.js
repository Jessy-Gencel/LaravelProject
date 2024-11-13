import { Spawner } from "../EnemySpawner";
const SpawnerMixin = (superclass) => class extends superclass {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        this.spawnCooldown = enemyConfig.spawn_rate * 1000; 
        this.spawnCount = 1;
        this.spawnElapsed = 0; 
        this.spawner = new Spawner(scene, x, y, row, this.scene.enemies); 
        this.updates.push("spawnerUpdate");
        this.type.push("spawner");
    }

    spawnerUpdate(time, delta) {
        this.spawnElapsed += delta;
        this.spawner.setPosition(this.x, this.y);
        if (this.spawnElapsed >= this.spawnCooldown) {
            this.spawnElapsed = 0;
            this.spawnEnemies();
        }
    }

    spawnEnemies() {
        for (let i = 0; i < this.spawnCount; i++) {
            this.spawner.spawnEnemy('minion')
        }
    }

    die() {
        super.die(); 
    }
};
export { SpawnerMixin };
