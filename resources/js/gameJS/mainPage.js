import Phaser from 'phaser';
import {loadTowers} from './towerLoad.js';
import {setupUIHandlers,updateCurrencyText} from './setupUIHandlers.js';
import {createTowerSelectionUI} from './createUI.js';
import { setBackground,makeGrid } from './gameBoardSetup.js';
import { OreMine } from './classes/OreMine.js';
import { setupOreMines } from './setupOreMines.js';
import { setupPlacedTowersDict } from './setupPlacedTowersDict.js';
import { gridConfig } from './gridConfig.js';
import { updateProjectiles } from './checkForProjectileUpdates.js';
import { loadEnemies } from './enemyLoad.js';
import { triggerRandomSpawner,startRandomWaveSpawner } from './waveControlFunctions.js';
import { ProjectileManager } from './classes/ProjectileManager.js';
import { EnemyManager } from './classes/EnemyManager.js';

class MyGame extends Phaser.Scene {
    constructor() {
        super({ key: 'MyGame' ,debug: true});
        this.music = {};
        this.background = null; 
        this.gridCells = [];
        this.towers = [];
        this.enemies = [];
        this.currency = 300;
        this.placedTowers = {};
        this.enemies = [];
        this.enemySpawners = [];
        this.selectedTower = null;
        this.draggingTower = null;
        this.uiContainer = null;
        this.OreMines = [];
        this.currencyText = null;
        this.enemyManager = null;
        this.projectileManager = null;
    }

    preload() {
        this.load.image('background', 'storage/assets/env/background.png');
        this.load.image('currencyIconKey', 'storage/assets/misc/money.png');
        this.load.image('upgradeButton', 'storage/assets/misc/upgrade_button.png');
        this.load.image('buildButton', 'storage/assets/misc/build_button.png');
        const towersPromise = loadTowers.call(this).then((towers) => {
            this.towers = towers;
            this.towers.forEach(tower => {
                this.load.image(tower.name, tower.sprite_image);
                console.log(tower.sprite_image);
                this.load.image(`${tower.name}_projectile`, tower.projectile_image);
            });
        });
        const enemiesPromise = loadEnemies().then((enemies) => {
            this.enemies = enemies;
            console.log(this.enemies);
            this.enemies.forEach(enemy => {
                this.load.image(enemy.name, enemy.sprite);
                if (enemy.projectile_sprite && !enemy.projectile_sprite.split('/').pop().includes('null')) {
                    this.load.image(`${enemy.name}_projectile`, enemy.projectile_sprite);
                }
            });
        });
        for (let i = 1; i <= 12; i++) {
            this.load.image(`oreminelvl${i}`, `storage/assets/oremines/ore_mine_lvl${i}.png`);
        }
        Promise.all([towersPromise, enemiesPromise]).then(() => {
            this.load.audio('backgroundMusic1', 'storage/audio/background_music.mp3');
            this.load.audio('bossMusic1', 'storage/audio/boss_music.mp3');
            this.load.start();
        });
    }

    create() {
        this.projectileManager = new ProjectileManager(this,this.physics.add.group());
        this.enemyManager = new EnemyManager(this);
        this.sound.pauseOnBlur = false;
        setBackground(this);
        makeGrid(this); 
        this.gridCells = Array.from({ length: gridConfig.numRows }, () => Array(gridConfig.numCols).fill({ occupied: false }));
        setupUIHandlers(this);
        setupOreMines(this);
        setupPlacedTowersDict(this);
        this.OreMines[2].purchase();
        this.load.on('complete', () => {
            this.music['background1'] = this.sound.add('backgroundMusic1', {
                volume: 0.3, 
                loop: false  
            });
            this.music['background1'].play();
            this.time.addEvent({
                delay: this.music['background1'].duration * 1000 - 1000,
                callback: () => {
                    this.music['background1'].setSeek(1);
                },
                callbackScope: this,
                loop: true
            });
            this.music['boss1'] = this.sound.add('bossMusic1', {
                volume: 0.3, 
                loop: false  
            });
            console.log(this.music);

            createTowerSelectionUI(this);
            this.enemyManager.placeBaseSpawners();
            startRandomWaveSpawner.call(this);
            this.physics.add.overlap(this.projectileManager.projectiles, this.enemyManager.activeEnemies, this.projectileManager.handleCollision, null, this.projectileManager);
        });
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
        if (this.projectileManager){
            this.projectileManager.update(delta);
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
    physics:{
        default: 'arcade',
        arcade: {
            debug: true,
        }
    }
};



const game = new Phaser.Game(config);

