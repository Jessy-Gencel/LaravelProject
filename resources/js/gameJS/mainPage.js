import Phaser from 'phaser';
import {loadTowers} from './towerLoad.js';
import {setupUIHandlers,updateCurrencyText} from './setupUIHandlers.js';
import {createTowerSelectionUI} from './createUI.js';
import { setBackground,makeGrid } from './gameBoardSetup.js';
import { OreMine } from './classLibrary.js';


const gridConfig = {
    numRows: 5,
    numCols: 9,
    startOffsetx: 150,
    startOffsety: 150,
    bottomOffset: 50,
    rightOffset: 50,
    get availableWidth() {
        return window.innerWidth - this.startOffsetx - this.rightOffset;
    },
    get squareWidth() {
        return this.availableWidth / this.numCols;
    },
    get squareHeight() {
        return (window.innerHeight - this.startOffsety - this.bottomOffset) / this.numRows;
    }
};

class MyGame extends Phaser.Scene {
    constructor() {
        super({ key: 'MyGame' ,debug: true});
        this.background = null; 
        this.gridCells = [];
        this.towers = [];
        this.currency = 300;
        this.placedTowers = [];
        this.enemies = [];
        this.spawnedEnemies = 0;
        this.selectedTower = null;
        this.draggingTower = null;
        this.uiContainer = null;
        this.OreMines = [];
        this.currencyText = null;
    }

    preload() {
        this.load.image('background', 'storage/assets/env/background.png');
        this.load.image('currencyIconKey', 'storage/assets/misc/money.png');
        this.load.image('upgradeButton', 'storage/assets/misc/upgrade_button.png');
        this.load.image('buildButton', 'storage/assets/misc/build_button.png');
        loadTowers.call(this).then((towers) => {
            this.towers = towers;
            this.towers.forEach(tower => {
            this.load.image(tower.name, tower.sprite_image);
            console.log(tower.sprite_image);
            this.load.image(`${tower.name}_projectile`, tower.projectile_image);
            });
            this.load.start(); 
        });
        for (let i = 1; i <= 12; i++) {
            this.load.image(`oreminelvl${i}`, `storage/assets/oremines/ore_mine_lvl${i}.png`);
        }
    }

    create() {
        this.load.on('complete', () => {
            createTowerSelectionUI(this);
        });
        setBackground(this);
        makeGrid(this, gridConfig); 
        this.gridCells = Array.from({ length: gridConfig.numRows }, () => Array(gridConfig.numCols).fill({ occupied: false }));
        setupUIHandlers(this, gridConfig);
        for (let row = 0; row < gridConfig.numRows; row++) {
            const x = 70; // Set X-position for factory icons on the left
            const y = gridConfig.startOffsety + gridConfig.squareHeight/2 + row * gridConfig.squareHeight;
            const OreMine1 = new OreMine(this, x, y, 50, 10); 
            this.OreMines.push(OreMine1);
        }
        
        // Initial free factory in the middle row
        this.OreMines[2].purchase();
    
    }

    update(time, delta) {
        if (this.background) {
            this.background.tilePositionX += 0.5; 
            this.background.tilePositionY += 0.2;
        }
        if (this.currencyText) {
            this.currencyText.setText(`${this.currency}`);
        }
        for (let oremine of this.OreMines) {
            if (oremine.isPurchased) {
               oremine.checkIfCanUpgrade();
            }else{
                oremine.checkIfCanBuy();
            }
        }
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

