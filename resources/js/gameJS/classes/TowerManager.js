class TowerManager {
    constructor(scene) {
        this.scene = scene;
        this.towers = this.scene.physics.add.group();
    }

    addTower(tower) {
        this.scene.add.existing(tower);
        this.scene.physics.add.existing(tower);
        tower.setImmovable(true);
        tower.setAngle(tower.rotation_angle); 
        tower.startShooting();
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