import { gridConfig } from "../../gridConfig.js";
const TeleporterMixin = (superclass) => class extends superclass {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        this.laneCount = gridConfig.numRows;
        this.justTeleported = false;
        this.type.push("teleporter");
    }
    teleport() {
        let newLane = Phaser.Math.Between(0, this.laneCount - 1);
        while (newLane === this.row) {
            newLane = Phaser.Math.Between(0, this.laneCount - 1);
        }
        this.row = newLane;
        this.updatePosition();
        this.justTeleported = true;
        this.scene.enemyManager.stopDamageOverTime(this);
        
    }

    updatePosition() {
        this.y = this.getLaneYPosition(this.row);
        this.setPosition(this.x, this.y);
    }
    getLaneYPosition(rowIndex) {
        return gridConfig.startOffsety + rowIndex * gridConfig.squareHeight + gridConfig.squareHeight / 2;
    }
};
export { TeleporterMixin };
