<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Gender Rate</title>
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
            const apiResponse = await fetch(`https://pokeapi.co/api/v2/pokemon-species/${name}`);
            if (!apiResponse.ok) throw new Error('API request failed');

            const data = await apiResponse.json();
            console.log(data);
            const genderRate = data.gender_rate;

            if (genderRate === -1) {
                const sqlStatement = `INSERT INTO pokemon_gender (Pokemon, Gender) VALUES (${pokemon.ID}, 'Genderless');`;
                await fetch('execute_sql.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ sql: sqlStatement })
                });
            } else {
                const femaleSql = `INSERT INTO pokemon_gender (Pokemon, Gender) VALUES (${pokemon.ID}, 'Female');`;
                const maleSql = `INSERT INTO pokemon_gender (Pokemon, Gender) VALUES (${pokemon.ID}, 'Male');`;

                await fetch('execute_sql.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ sql: femaleSql })
                });

                await fetch('execute_sql.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ sql: maleSql })
                });
            }
        } catch (error) {
            errors.push(name);
        }
    }

    document.getElementById('output').textContent = `Errors: ${errors.join(', ')}`;
}

</script>