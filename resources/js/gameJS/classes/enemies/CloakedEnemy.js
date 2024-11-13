const CloakedEnemyMixin = (superclass) => class extends superclass {
    constructor(scene, x, y, row, enemyConfig) {
        super(scene, x, y, row, enemyConfig);
        this.isCloaked = true; 
        this.cloakDuration = enemyConfig.cloak_duration * 1000;  
        this.cloakRadius = enemyConfig.cloak_radius || 100;
        this.cloakCooldown = enemyConfig.cloak_cooldown * 1000 || 5000;
        this.timerBased = enemyConfig.timer_based || false;
        this.proximityBased = enemyConfig.proximity_based || false;  
        this.timeSinceUncloaked = 0  
        this.timeCloaked = 0; 
        this.updates.push("updateCloaking");
        this.type.push("cloaked");
        this.cloak();
    }

    updateCloaking(time, delta) {
        if (this.proximityBased){
            if (this.shouldUncloak()){
                this.uncloak();
            }else{
                this.cloak();
            }
        }
        if (this.timerBased) {
            if (this.isCloaked) {
            this.alpha = 0.5; 
            this.timeCloaked += delta;  
            if (this.timeCloaked >= this.cloakDuration) {
                this.uncloak();
            }
            } else {
            this.timeSinceUncloaked += delta; 
            if (this.timeSinceUncloaked >= this.cloakCooldown) {
                    this.cloak();
                    this.timeCloaked = 0; 
                    this.totalTimeCloaked = 0;
                }
            }
        }
    }
    shouldUncloak() {
        const row = this.row;
        const towersInRow = this.scene.placedTowers[row];
        if (towersInRow) {
            for (let col = Object.keys(towersInRow).length - 1; col >= 0; col--) {
                const tower = towersInRow[col];
                if (!tower) {
                    continue;
                }
                const distance = Math.abs(this.x - tower.x);
                if (distance <= this.cloakRadius) {
                    return true;
                }
            }
        }
        return false;
    }

    uncloak() {
        this.isCloaked = false;
        this.timeSinceUncloaked = 0;
        this.alpha = 1;
    }

    cloak() {
        this.isCloaked = true;
        this.alpha = 0.5;  
    }

}
export { CloakedEnemyMixin };
