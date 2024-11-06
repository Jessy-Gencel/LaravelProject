class TowerManager {
    constructor(scene) {
        this.scene = scene;
        this.towers = this.scene.physics.add.group();
    }

    addTower(tower) {
        this.towers.add(tower);
    }

    removeTower(tower) {
        this.towers.remove(tower);
    }

    getTowers() {
        return this.towers;
    }

    updateTowers() {
        this.towers.forEach(tower => {
            tower.update();
        });
    }
}

export {TowerManager};