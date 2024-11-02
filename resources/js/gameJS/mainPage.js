import Phaser from 'phaser';
import {loadTowers} from './towerLoad.js';

const numRows = 5;
const numCols = 9;
const startOffsetx = 150; 
const startOffsety = 150;
const bottomOffset = 50;
const rightOffset = 50;
const availableWidth = window.innerWidth - startOffsetx - rightOffset; 
const squareWidth = availableWidth / numCols; 
const squareHeight = (window.innerHeight - startOffsety - bottomOffset)/ numRows; 




class MyGame extends Phaser.Scene {
    constructor() {
        super({ key: 'MyGame' ,debug: true});
        this.background = null; 
        this.gridCells = [];
        this.towers = [];
        this.currency = 0;
        this.placedTowers = [];
        this.enemies = [];
        this.spawnedEnemies = 0;
        this.selectedTower = null;
    }

    preload() {
        this.load.image('background', 'storage/assets/env/background.png');
        this.load.image('currencyIconKey', 'storage/assets/misc/money.png');
        loadTowers.call(this).then((towers) => {
            this.towers = towers;
            this.towers.forEach(tower => {
            this.load.image(tower.name, tower.sprite_image);
            console.log(tower.sprite_image);
            this.load.image(`${tower.name}_projectile`, tower.projectile_image);
            });
            this.load.start(); 
        });
    }

    create() {
        this.load.on('complete', () => {
            this.createTowerSelectionUI();
        });
        this.setBackground();
        this.makeGrid(); 
        this.gridCells = Array.from({ length: numRows }, () => Array(numCols).fill({ occupied: false }));
        this.input.on('pointerdown', (pointer) => {
            if (!this.selectedTower) return;
            const col = Math.floor((pointer.x - startOffsetx) / squareWidth);
            const row = Math.floor((pointer.y - startOffsety) / squareHeight);
            if (col >= 0 && col < numCols && row >= 0 && row < numRows) {
            const x = startOffsetx + col * squareWidth + squareWidth / 2;
            const y = startOffsety + row * squareHeight + squareHeight / 2;    
            if (!this.gridCells[row][col].occupied && this.currency >= this.selectedTower.price) {
                // Place the tower sprite at the calculated position
                const towerSprite = this.add.sprite(x, y, this.selectedTower.name);
                towerSprite.setDisplaySize(squareWidth * 0.8, squareHeight * 0.8); 
                console.log(this.selectedTower.rotation_angle)
                towerSprite.setAngle(this.selectedTower.rotation_angle);
                // Mark the cell as occupied
                this.gridCells[row][col] = { occupied: true };
                // Deduct the tower price from player currency and update the UI
                this.currency -= this.selectedTower.price;
                // Reset selectedTower to prevent multiple placements
                this.selectedTower = null;
            }
            } else {
            console.log(`Outside of grid`);
            }
        });
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
        const graphics = this.add.graphics(); 
        
        graphics.lineStyle(2, 0x808080, 1);
        for (let row = 0; row < numRows; row++) {
            for (let col = 0; col < numCols; col++) {
                const x = col * squareWidth + startOffsetx;
                const y = row * squareHeight + startOffsety;
                graphics.strokeRect(x, y, squareWidth, squareHeight);
            }
        }
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
            towerBox.setInteractive();
            towerBox.on('pointerdown', () => {
                console.log(`Selected ${tower.name}`);
                this.selectedTower = tower;  
                uiContainer.list.forEach(child => {
                    if (child === towerBox) {
                        child.setFillStyle(0x777777);  
                    } else if (child.fillColor === 0x777777) {
                        child.setFillStyle(0x555555); 
                    }
                });
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

