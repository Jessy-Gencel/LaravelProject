import Phaser from 'phaser';
import {loadTowers} from './towerLoad.js';
import {setupUIHandlers,updateCurrencyText} from './setupUIHandlers.js';
import {createTowerSelectionUI} from './createUI.js';
import { OreMine } from './classes/OreMine.js';
import { gridConfig } from './gridConfig.js';
import { updateProjectiles } from './checkForProjectileUpdates.js';
import { loadEnemies } from './enemyLoad.js';
import { initialize } from './init.js';
import { WaveController } from './classes/WaveController.js';

class MyGame extends Phaser.Scene {
    constructor() {
        super({ key: 'MyGame' ,debug: true});
        this.music = {};
        this.background = null; 
        this.environmentLayer = null;
        this.gridCells = [];
        this.towers = [];
        this.enemies = [];
        this.score = 0;
        this.currency = 300;
        this.placedTowers = {};
        this.enemies = {};
        this.enemySpawners = [];
        this.selectedTower = null;
        this.draggingTower = null;
        this.uiContainer = null;
        this.OreMines = [];
        this.currencyText = null;
        this.enemyManager = null;
        this.projectileManager = null;
        this.towerManager = null;
        this.waveController = null;
    }

    preload() {
        this.load.image('background', 'storage/assets/env/background.png');
        this.load.image('currencyIconKey', 'storage/assets/misc/money.png');
        this.load.image('healEffect', 'storage/assets/misc/heal_effect.webp');
        this.load.image('upgradeButton', 'storage/assets/misc/upgrade_button.png');
        this.load.image('buildButton', 'storage/assets/misc/build_button.png');
        this.load.image('rock', 'storage/assets/env/rock.png');
        this.load.json('waveData', 'storage/json/waveConfig.json');

        const towersPromise = loadTowers.call(this).then((towers) => {
            this.towers = towers;
            this.towers.forEach(tower => {
                this.load.image(tower.name, tower.sprite_image);
                this.load.image(`${tower.name}_projectile`, tower.projectile_image);
            });
        });
        const enemiesPromise = loadEnemies().then((enemies) => {
            this.enemies = enemies;
            Object.keys(this.enemies).forEach(enemyKey => {
                const enemy = this.enemies[enemyKey];
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
        this.add.circle
        this.time.delayedCall
        initialize(this);
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
            console.log(this.music)
            createTowerSelectionUI(this);
            const waveData = this.cache.json.get('waveData');
            this.waveController = new WaveController(this, waveData);
            this.enemyManager.placeBaseSpawners();
            this.physics.add.overlap(this.projectileManager.projectiles, this.enemyManager.enemies, this.projectileManager.handleCollision, null, this.projectileManager);
            this.physics.add.overlap(this.enemyManager.enemies, this.towerManager.towers, this.enemyManager.startDamageOverTime, null, this.enemyManager);
            this.physics.add.overlap(this.projectileManager.projectiles, this.enemyManager.rangedEnemies, this.projectileManager.handleCollision, null, this.projectileManager);
            this.physics.add.overlap(this.projectileManager.enemyProjectiles, this.towerManager.towers, this.projectileManager.handleEnemyProjectileCollision, null, this.projectileManager);
            this.waveController.startWave(0);
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
        if (this.enemyManager){
            this.enemyManager.updateEnemies(time, delta);
            this.enemyManager.updateRangedEnemies(time, delta);
        }
    }
    createEnvironmentSprites() {
        const tree = this.add.sprite(300, 400, 'rock');
        tree.setScale(0.5);  
        this.environmentLayer.add(tree);

        const rock = this.add.sprite(1000, 600, 'rock');
        rock.setScale(0.5);
        this.environmentLayer.add(rock);
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
