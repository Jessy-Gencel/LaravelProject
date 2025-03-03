async function loadTowers() {
    try {
        const response = await fetch('http://localhost:8000/api/towers', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-referer': window.location.href,
            },
        });

        if (!response.ok) {
            throw new Error(`Failed to fetch towers: ${response.statusText}`);
        }

        const towers = await response.json();
        const formattedtowers = towers.map(tower => ({
            name: tower.name,
            price: tower.price,
            sprite_image: `storage/assets/towers/${tower.sprite_image}`,
            projectile_image: `storage/assets/projectiles/${tower.projectile_image}`,
            damage: tower.damage,
            hitpoints: tower.hitpoints,
            attackSpeed: tower.fire_rate,
            rotation_angle: tower.rotation_angle,
            projectileSpeed: tower.projectile_speed,
            range: tower.range,
        }));
        return formattedtowers;
    } catch (error) {
        console.error('Error fetching towers:', error);
        return [];
    }
}

export { loadTowers };