import { gridConfig } from "../../gridConfig";
const JuggernautBossMixin = (superclass) => class extends superclass {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        this.laneCount = gridConfig.numRows;
        this.firstPhase = true;
        this.secondPhase = false;
        this.thirdPhase = false; 
        this.updates.push("updateJuggernaut");
        this.dies.push("dieJuggernaut");
        this.type.push("juggernaut");
        this.changeMusic()
    }
    changeMusic(){
        this.scene.music['background1'].pause();
        this.scene.music['boss1'].play();
    }
    teleport(final = false) {
        let newLane = Phaser.Math.Between(1, this.laneCount - 2);
        while (newLane === this.row) {
            newLane = Phaser.Math.Between(1, this.laneCount - 2);
        }
        this.row = newLane;
        if (final) {
            this.updatePosition(true);
        }else{
            this.updatePosition(false);
        }
        console.log('teleporting');
        this.scene.enemyManager.stopDamageOverTime(this);
    }
    dieJuggernaut() {
        this.scene.music['boss1'].pause();
        this.scene.music['background1'].play();
        this.scene.enemyManager.stopDamageOverTime(this);
    }
    updatePosition(final) {
        this.y = this.getLaneYPosition(this.row);
        if (final) {
            this.setPosition(this.x -300, this.y);
        }else{
            this.setPosition(this.x, this.y);
        }
    }
    getLaneYPosition(rowIndex) {
        return gridConfig.startOffsety + rowIndex * gridConfig.squareHeight + gridConfig.squareHeight / 2;
    }
    updateJuggernaut(time, delta) {
        this.checkTeleportation();
    }
    checkTeleportation() {
        const healthPercentage = this.remainingHealth / this.health;
        if (healthPercentage <= 0.75 && healthPercentage > 0.5  && this.firstPhase) {
            this.teleport(); 
            this.firstPhase = false;
            this.secondPhase = true;
        } else if (healthPercentage <= 0.50 && healthPercentage > 0.25 && this.secondPhase) {
            this.teleport();  
            this.restoreBarrier();
            this.secondPhase = false;
            this.thirdPhase = true;
        } else if (healthPercentage <= 0.25 && healthPercentage > 0 && this.thirdPhase) {
            this.teleport(true);
            this.thirdPhase = false;
        }
    }
};

export { JuggernautBossMixin };