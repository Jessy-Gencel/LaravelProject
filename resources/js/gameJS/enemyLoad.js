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
                name: enemy.name || null,
                type: enemy.type || null,
                health: enemy.health || null,
                speed: enemy.speed || null,
                damage: enemy.damage || null,
                score: enemy.score || null,
                range: enemy.range || null,
                fire_rate: enemy.fire_rate || null,
                sprite: enemy.sprite ? `storage/assets/enemies/${enemy.sprite}` : null,
                sound: enemy.sound ? `storage/assets/sounds/${enemy.sound}` : null,
                projectile_sprite: enemy.projectile_sprite ? `storage/assets/projectiles/${enemy.projectile_sprite}` : null,
                projectile_sound: enemy.projectile_sound ? `storage/assets/sounds/${enemy.projectile_sound}` : null,
                projectile_speed: enemy.projectile_speed || null,
                heal_amount: enemy.heal_amount || null,
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