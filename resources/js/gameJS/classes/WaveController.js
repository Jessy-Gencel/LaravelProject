class WaveController {
    constructor(scene, waves) {
        this.scene = scene;
        this.enemyManager = scene.enemyManager;
        this.waves = waves; 
        this.currentWave = 0;
        this.currentDelay = 7000; 
        this.minimumDelay = 1000; 
        this.delayReductionFactor = 0.95; 
    }

    startWave(waveIndex) {
        const wave = this.waves[waveIndex];
        if (!wave) return;
    
        let lastSpawnTime = 0; // Track the last spawn time for the current wave
    
        wave.enemies.forEach((enemyConfig, index) => {
            const spawnTime = enemyConfig.delay || 0;
    
            // Update the last spawn time to be the max of its current value and the new enemy's spawn time
            lastSpawnTime = Math.max(lastSpawnTime, spawnTime);
    
            this.scene.time.delayedCall(spawnTime, () => {
                const spawner = this.enemyManager.spawners[enemyConfig.spawnerIndex];
                spawner.spawnEnemy(enemyConfig.type);
            });
        });
    
        // After the last enemy is spawned, wait for the spawnInterval and then start the next wave
        const spawnInterval = wave.spawnInterval || 2000;  // Default to 2000 if not defined
        const timeToNextWave = lastSpawnTime + spawnInterval;
    
        // Delay the call to start the next wave
        this.scene.time.delayedCall(timeToNextWave, () => {
            this.scene.events.emit('nextWave', wave.wave + 1);
            this.startWave(waveIndex + 1);
        });
    }
    

    triggerRandomSpawner() {
        const spawnerIndex = Phaser.Math.Between(0, this.enemyManager.spawners.length - 1);
        const chosenSpawner = this.enemyManager.spawners[spawnerIndex];
        console.log(chosenSpawner);
    
        if (chosenSpawner) {
            chosenSpawner.spawnEnemy();
        }
    }
    
    startRandomWaveSpawner() {
        this.scene.time.addEvent({
            delay: this.currentDelay,
            callback: () => {
                this.triggerRandomSpawner();
                this.currentDelay = Math.max(this.currentDelay * this.delayReductionFactor, this.minimumDelay);
                this.startRandomWaveSpawner();
            },
            callbackScope: this,
        });
    }
}
export { WaveController };