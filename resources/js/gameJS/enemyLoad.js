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
                attack_speed: enemy.attack_speed || null,
                sprite: enemy.sprite ? `storage/assets/enemies/${enemy.sprite}` : null,
                sound: enemy.sound ? `storage/assets/sounds/${enemy.sound}` : null,
                projectile_sprite: enemy.projectile_sprite ? `storage/assets/projectiles/${enemy.projectile_sprite}` : null,
                projectile_sound: enemy.projectile_sound ? `storage/assets/sounds/${enemy.projectile_sound}` : null,
                projectile_speed: enemy.projectile_speed || null,
                fire_rate: enemy.fire_rate || null,
                heal_amount: enemy.heal_amount || null,
                heal_rate: enemy.heal_rate || null,
                heal_range: enemy.heal_range || null,
                barrier_health: enemy.barrier_health || null,
                barrier_cooldown: enemy.barrier_cooldown || null,
                barrier_regen: enemy.barrier_regen || null,
                barrier_regen_cooldown: enemy.barrier_regen_cooldown || null,
                barrier_radius: enemy.barrier_radius || null,
                spawn_rate: enemy.spawn_rate || null,
                cloak_duration: enemy.cloak_duration || null,
                cloak_radius: enemy.cloak_radius || null,
                cloak_cooldown: enemy.cloak_cooldown || null,
                timer_based: enemy.timer_based || null,
                proximity_based: enemy.proximity_based || null,
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