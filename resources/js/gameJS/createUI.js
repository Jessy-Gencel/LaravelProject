function createTowerSelectionUI(game) {
    const uiContainer = game.add.container(20, 10);
    game.uiContainer = uiContainer;
    const boxWidth = 100;
    const boxHeight = 100; 
    const padding = 10;
    const currencyBoxWidth = 80;
    const towerSelectionWidth = game.towers.length * (boxWidth + padding);
    // Background box for the entire UI container (currency + tower selection)
    const totalWidth = currencyBoxWidth + padding + towerSelectionWidth + padding;
    const totalHeight = boxHeight + 2 * padding;
    const backgroundBox = game.add.rectangle(totalWidth / 2, totalHeight / 2, totalWidth, totalHeight, 0x333333);
    backgroundBox.setOrigin(0.5, 0.5);
    uiContainer.add(backgroundBox);
    // Currency Icon 
    const currencyIcon = game.add.image(30, totalHeight / 2 -15, 'currencyIconKey').setDisplaySize(30, 30);
    uiContainer.add(currencyIcon);
    // Currency Display 
    game.currencyText = game.add.text(30, totalHeight / 2 + 15, `${game.currency}`, { 
        fontSize: '18px',
        color: '#FFFFFF',
    }).setOrigin(0.5, 0.5);
    uiContainer.add(game.currencyText);
    // Starting position for the tower selection boxes
    const towerStartX = 30 + currencyBoxWidth + padding; 
    // Create tower selection boxes
    game.towers.forEach((tower, index) => {
        const xPosition = towerStartX + index * (boxWidth + padding); 
        const yPosition = totalHeight / 2; 

        // Tower selection box
        const towerBox = game.add.rectangle(xPosition, yPosition, boxWidth, boxHeight, 0x555555);
        towerBox.setOrigin(0.5, 0.5);
        const towerImage = game.add.image(xPosition, yPosition - 10, tower.name).setDisplaySize(80, 80); 
        uiContainer.add(towerBox);
        uiContainer.add(towerImage);

        // Tower price text 
        const priceText = game.add.text(xPosition, yPosition + 30, `${tower.price}`, {
            fontSize: '16px',
            color: '#FFFFFF',
        }).setOrigin(0.5, 0); 
        uiContainer.add(priceText);
        towerBox.setInteractive();
        towerBox.on('pointerdown', () => {
            game.selectedTower = tower;  
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

export {createTowerSelectionUI};