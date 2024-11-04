class OreMine {
    constructor(scene, x, y, cost, income, level = 1) {
        this.scene = scene;
        this.sprite = scene.add.sprite(x, y, 'buildButton'); 
        this.cost = cost;
        this.income = income;
        this.level = level;
        this.isPurchased = false;
        this.costText = scene.add.text(x - 25, y - 20, `Cost: ${this.cost}`, { fontSize: '12px', color: '#fff' });
        this.mineralSprite = null;
        this.levelText = null;
        this.maxLevel = false;
        this.initialize();
    }
    initialize() {
        this.sprite.setScale(0.25);
        this.sprite.setInteractive();
        this.costText.setPosition(this.sprite.x - 15, this.sprite.y - 60);
        this.costText.setStyle({ fontSize: '24px', color: '#fff', fontStyle: 'bold', backgroundColor: '#000', padding: { left: 5, right: 5, top: 2, bottom: 2 } });
        this.sprite.on('pointerdown', () => this.handlePurchaseOrUpgrade());
        this.sprite.on('pointerover', () => {
            this.costText.setText(`${this.cost}`);
            this.costText.setVisible(true);
        });
        this.sprite.on('pointerout', () => {
            this.costText.setVisible(false);
        });
        this.costText.setVisible(false);
    }

    
    handlePurchaseOrUpgrade() {
        if (!this.isPurchased && this.scene.currency >= this.cost) {
            this.purchase();
        } else if (this.isPurchased && this.scene.currency >= this.getUpgradeCost()) {
            this.upgrade();
        }
        this.realingCostText()
    }
    realingCostText() {
        const upgradeCost = this.getUpgradeCost();
        const costLength = upgradeCost.toString().length;
        if (costLength === 2) { 
            this.costText.setPosition(this.sprite.x - 15, this.sprite.y - 60);
        } else if (costLength === 3) {
            this.costText.setPosition(this.sprite.x - 22, this.sprite.y - 60);
        } else if (costLength === 4) {
            this.costText.setPosition(this.sprite.x - 28, this.sprite.y - 60);
        } else {
            this.costText.setPosition(this.sprite.x - 45, this.sprite.y - 60);
        }
    }

    purchase() {
        this.scene.currency -= this.cost;
        this.isPurchased = true;
        this.sprite.destroy(); // Remove the gray rectangle
        this.costText.setVisible(false);
        this.startIncome();
        // First purchase creates a mineral sprite below
        this.mineralSprite = this.scene.add.image(this.sprite.x, this.sprite.y, 'oreminelvl1');
        this.mineralSprite.setVisible(true);
        this.createUpgradeButton();
        this.levelText = this.scene.add.text(this.sprite.x, this.sprite.y + 40, `Level: ${this.level}`, { fontSize: '16px', color: '#fff' });
        this.levelText.setOrigin(0.5, 0.5);
        this.levelText.setPosition(this.sprite.x, this.sprite.y + 80);
        this.scene.children.bringToTop(this.levelText);
    }

    createUpgradeButton() {
        this.upgradeButton = this.scene.add.sprite(this.sprite.x, this.sprite.y, 'upgradeButton'); 
        this.upgradeButton.setScale(0.25); 
        this.upgradeButton.setInteractive();
        this.upgradeButton.on('pointerover', () => {
            this.costText.setText(`${this.getUpgradeCost()}`);
            this.costText.setVisible(true);
        });

        this.upgradeButton.on('pointerout', () => {
            this.costText.setVisible(false);
        });

        this.upgradeButton.on('pointerdown', () => this.handlePurchaseOrUpgrade());
        this.bringUpgradeButtonToFront();
    }
    bringUpgradeButtonToFront() {
        this.scene.children.bringToTop(this.upgradeButton);
        this.scene.children.bringToTop(this.costText);
    }

    upgrade() {
        this.costText.setVisible(false);
        const upgradeCost = this.getUpgradeCost();
        if (this.checkIfCanUpgrade()) {
            this.scene.currency -= upgradeCost;
            this.level += 1;
            this.income += 5;
            this.mineralSprite.destroy();
            this.mineralSprite = this.scene.add.image(this.sprite.x, this.sprite.y, `oreminelvl${this.level}`);
            this.levelText.setText(`Level: ${this.level}`);
            this.bringUpgradeButtonToFront();
            this.checkRescale();
            if (this.level === 12) {
                this.maxLevelHandling();
            }
        }
    }
    checkIfCanUpgrade() {
        if (this.maxLevel) {
            return false;	
        }
        if (this.scene.currency >= this.getUpgradeCost()) {
            this.upgradeButton.setTint(0x66ff66); 
            return true;
        }else{
            this.upgradeButton.setTint(0x999999);
            return false;
        }
    }
    checkIfCanBuy(){
        if (this.scene.currency >= this.cost) {
            this.sprite.setTint(0x66ff66);
            return true;
        }else{
            this.sprite.setTint(0x999999);
            return false;
        }
    }
    checkRescale(){
        if (this.level > 4 && this.level <= 8) {
            this.mineralSprite.setScale(0.5);
        }else if (this.level > 8) {
            this.mineralSprite.setScale(0.28,0.25);
        }
    }

    getUpgradeCost() {
        return this.cost * this.level * 1.5; 
    }
    maxLevelHandling(){
        this.upgradeButton.destroy();
        this.costText.destroy();
        this.cost = 999999999999999;
        this.maxLevel = true;
    }

    startIncome() {
        this.scene.time.addEvent({
            delay: 3000, 
            callback: () => {
                if (this.isPurchased) {
                    this.scene.currency += this.income;
                }
                this.animateIncome();
            },
            loop: true
        });
    }
    animateIncome() {
        const moneyIcon = this.scene.add.image(this.mineralSprite.x, this.mineralSprite.y, 'currencyIconKey');
        moneyIcon.setScale(0.5);
        this.scene.tweens.add({
            targets: moneyIcon,
            y: moneyIcon.y - 50,
            alpha: 0,
            duration: 1000,
            ease: 'Power1',
            onComplete: () => {
                moneyIcon.destroy();
            }
        });

        this.scene.tweens.add({
            targets: this.mineralSprite,
            scaleX: 0.6,
            scaleY: 0.6,
            yoyo: true,
            duration: 200,
            ease: 'Power1'
        });
    }
    
}

export { OreMine };
