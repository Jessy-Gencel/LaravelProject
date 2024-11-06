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
        console.log(this.waves);
        const wave = this.waves[waveIndex];
        console.log(wave);
        if (!wave) return;

        wave.enemies.forEach((enemyConfig) => {
            const spawnTime = enemyConfig.delay || 0; // Use spawnTime if defined, otherwise default to 0

            this.scene.time.delayedCall(spawnTime, () => {
                const spawner = this.enemyManager.spawners[enemyConfig.spawnerIndex];
                spawner.spawnEnemy(enemyConfig.type);
            });
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