let currentDelay = 7000; 
const minimumDelay = 1000; 
const delayReductionFactor = 0.95; 

function triggerRandomSpawner() {
    const spawnerIndex = Phaser.Math.Between(0, this.enemyManager.spawners.length - 1);
    const chosenSpawner = this.enemyManager.spawners[spawnerIndex];
    console.log(chosenSpawner);

    if (chosenSpawner) {
        chosenSpawner.spawnEnemy();
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