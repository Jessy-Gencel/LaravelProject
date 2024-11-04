let currentDelay = 7000; 
const minimumDelay = 1000; 
const delayReductionFactor = 0.95; 

function triggerRandomSpawner() {
    // Randomly choose a spawner and start spawning
    const spawnerIndex = Phaser.Math.Between(0, this.enemySpawners.length - 1);
    const chosenSpawner = this.enemySpawners[spawnerIndex];

    if (chosenSpawner) {
        chosenSpawner.startSpawning();
    }
}

function startRandomWaveSpawner() {
    this.time.addEvent({
        delay: currentDelay,
        callback: () => {
            triggerRandomSpawner.call(this);
            currentDelay = Math.max(currentDelay * delayReductionFactor, minimumDelay);
            startRandomWaveSpawner.call(this);
        },
        callbackScope: this,
    });
}
export { triggerRandomSpawner, startRandomWaveSpawner };