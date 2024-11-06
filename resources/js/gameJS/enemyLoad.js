async function loadEnemies() {
    try {
        const response = await fetch('http://localhost:8000/api/enemies', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error(`Failed to fetch towers: ${response.statusText}`);
        }

        const enemies = await response.json();
        const formattedEnemies = enemies.reduce((acc, enemy) => {
            acc[enemy.name] = {
                name: enemy.name,
                health: enemy.health,
                speed: enemy.speed,
                damage: enemy.damage,
                score: enemy.score,
                sprite: `storage/assets/enemies/${enemy.sprite}`,
                sound: `storage/assets/sounds/${enemy.sound}`,
                projectile_sprite: `storage/assets/projectiles/${enemy.projectile_sprite}`,
                projectile_sound: `storage/assets/sounds/${enemy.projectile_sound}`,
                projectile_speed: enemy.projectile_speed,
            };
            return acc;
        }, {});
        return formattedEnemies;
    } catch (error) {
        console.error('Error fetching towers:', error);
        return [];
    }
}
export { loadEnemies };