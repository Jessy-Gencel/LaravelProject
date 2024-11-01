import Phaser from 'phaser';

class MyGame extends Phaser.Scene {
    constructor() {
        super({ key: 'MyGame' ,debug: true});
        this.background = null; 
        this.gridLines = [];
        this.towers = [
            { name: 'basicTower', image: 'storage/assets/towers/basicTower.png', price: 100 }, 
            { name: 'combustionTower', image: 'storage/assets/towers/combustionTower.png', price: 150 },
        ]
    }

    preload() {
        this.load.image('background', 'storage/assets/env/background.png');
        this.load.image('basicTower', 'storage/assets/towers/basicTower.png'); 
        this.load.image('combustionTower', 'storage/assets/towers/combustionTower.png');
        this.load.image('currencyIconKey', 'storage/assets/misc/money.png');
    }

    create() {
        this.setBackground(this);
        this.makeGrid(this); 
        this.createTowerSelectionUI(this);
    }

    update(time, delta) {
        if (this.background) {
            this.background.tilePositionX += 0.5; 
            this.background.tilePositionY += 0.2;
        }
    }

    setBackground() {
        this.background = this.add.tileSprite(0, 0, window.innerWidth, window.innerHeight, 'background');
        this.background.setOrigin(0, 0);
    }
    makeGrid() {
        const numRows = 5;
        const numCols = 9;
        const startOffsetx = 150; 
        const startOffsety = 100;
        const bottomOffset = 50;
        const rightOffset = 50;
        const availableWidth = window.innerWidth - startOffsetx - rightOffset; 
        const squareWidth = availableWidth / numCols; 
        const squareHeight = (window.innerHeight - startOffsety - bottomOffset)/ numRows; 
        const graphics = this.add.graphics(); 
        
        graphics.lineStyle(2, 0x808080, 1);
        for (let row = 0; row < numRows; row++) {
            for (let col = 0; col < numCols; col++) {
                const x = col * squareWidth + startOffsetx;
                const y = row * squareHeight + startOffsety;
                graphics.strokeRect(x, y, squareWidth, squareHeight);
            }
        }
        this.gridLines.push(graphics);
    }
    createTowerSelectionUI() {
        const uiContainer = this.add.container(20, 10);
    
        const boxWidth = 100;
        const boxHeight = 100; 
        const padding = 10;
        const currencyBoxWidth = 80;
        const towerSelectionWidth = this.towers.length * (boxWidth + padding);
        // Background box for the entire UI container (currency + tower selection)
        const totalWidth = currencyBoxWidth + padding + towerSelectionWidth + padding;
        const totalHeight = boxHeight + 2 * padding;
        const backgroundBox = this.add.rectangle(totalWidth / 2, totalHeight / 2, totalWidth, totalHeight, 0x333333);
        backgroundBox.setOrigin(0.5, 0.5);
        uiContainer.add(backgroundBox);
        // Currency Icon 
        const currencyIcon = this.add.image(30, totalHeight / 2 -15, 'currencyIconKey').setDisplaySize(30, 30);
        uiContainer.add(currencyIcon);
        // Currency Display 
        this.currency = 1000; 
        const currencyText = this.add.text(30, totalHeight / 2 + 15, `${this.currency}`, { 
            fontSize: '18px',
            color: '#FFFFFF',
        }).setOrigin(0.5, 0.5);
        uiContainer.add(currencyText);
        // Starting position for the tower selection boxes
        const towerStartX = 30 + currencyBoxWidth + padding; 
        // Create tower selection boxes
        this.towers.forEach((tower, index) => {
            const xPosition = towerStartX + index * (boxWidth + padding); 
            const yPosition = totalHeight / 2; 

            // Tower selection box
            const towerBox = this.add.rectangle(xPosition, yPosition, boxWidth, boxHeight, 0x555555);
            towerBox.setOrigin(0.5, 0.5);
            const towerImage = this.add.image(xPosition, yPosition - 10, tower.name).setDisplaySize(80, 80); 
            uiContainer.add(towerBox);
            uiContainer.add(towerImage);
    
            // Tower price text 
            const priceText = this.add.text(xPosition, yPosition + 30, `${tower.price}`, {
                fontSize: '16px',
                color: '#FFFFFF',
            }).setOrigin(0.5, 0); 
            uiContainer.add(priceText);
    
            // Make box interactive
            towerBox.setInteractive();
            towerBox.on('pointerdown', () => {
                console.log(`Selected ${tower.name} for ${tower.price}`);
            });
        });
    }
    
    
    
    
    
    
}
const config = {
    type: Phaser.AUTO,
    width: window.innerWidth,
    height: window.innerHeight,
    parent: 'phaser-game', 
    scene: MyGame, 
    scale: {
        mode: Phaser.Scale.RESIZE,
        autoCenter: Phaser.Scale.CENTER_BOTH,
    },
};

const game = new Phaser.Game(config);

