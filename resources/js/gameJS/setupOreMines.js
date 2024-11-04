import { OreMine } from "./classes/OreMine";
import { gridConfig } from "./gridConfig";
function setupOreMines(game) {
    for (let row = 0; row < gridConfig.numRows; row++) {
        const x = 70; // Set X-position for factory icons on the left
        const y = gridConfig.startOffsety + gridConfig.squareHeight/2 + row * gridConfig.squareHeight;
        const OreMine1 = new OreMine(game, x, y, 50, 10); 
        game.OreMines.push(OreMine1);
    }
}
export { setupOreMines };