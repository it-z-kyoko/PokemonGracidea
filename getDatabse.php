<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Moves</title>
</head>
<body>
    <button onclick="processPokemon()">Start Process</button>
    <div id="output"></div>
</body>
</html>

<script>
async function processPokemon() {
    const response = await fetch('get_pokemon_names.php');
    const pokemonList = await response.json();
    const errors = [];

    for (const pokemon of pokemonList) {
        const name = pokemon.Name.toLowerCase();
        try {
            const apiResponse = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}`);
            if (!apiResponse.ok) throw new Error('API request failed');
            const data = await apiResponse.json();

            const moves = data.moves;
            for (const move of moves) {
                const moveName = move.move.name;
                
                // Fetch move details from the temporary table
                const moveDetailsResponse = await fetch('get_move_details.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ name: moveName })
                });

                if (!moveDetailsResponse.ok) throw new Error('Failed to fetch move details');
                const moveDetails = await moveDetailsResponse.json();

                if (!moveDetails || !moveDetails.ID) {
                    errors.push(`Move not found: ${moveName}`);
                    continue;
                }

                const moveId = moveDetails.ID;
                const versionDetails = move.version_group_details;
                const latestVersionDetail = versionDetails[versionDetails.length - 1];
                const method = latestVersionDetail.move_learn_method.name;
                let nr = null;

                let condition;
                if (method === 'level-up') {
                    condition = 'Level Up';
                    nr =latestVersionDetail.level_learned_at;
                } else if (method === 'machine') {
                    condition = 'TM';
                } else if (method === 'tutor') {
                    condition = 'Tutor';
                } else {
                    condition = 'Other';
                }

                const sqlStatement = `INSERT INTO pokemon_moves (Pokemon, Move, Category, Nr) VALUES (${pokemon.ID}, '${moveId}', '${condition}', '${nr}');`;
                await fetch('execute_sql.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ sql: sqlStatement })
                });
            }
        } catch (error) {
            errors.push(name);
        }
    }

    document.getElementById('output').textContent = `Errors: ${errors.join(', ')}`;
}
</script>
