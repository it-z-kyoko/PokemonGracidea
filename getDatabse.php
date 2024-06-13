<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Evolutions</title>
</head>
<body>
    <button onclick="processPokemon()">Start Process</button>
    <div id="output"></div>
</body>
</html>

<script>
async function processPokemon() {
    const response = await fetch('get_pokemon_names.php');
    let pokemonList = await response.json();
    pokemonList = pokemonList.map(pokemon => {
        return {
            ...pokemon,
            Name: pokemon.Name.toLowerCase()
        };
    });
    const errors = [];

    for (let idx = 0; idx < 550; idx++) {
        try {
            const apiResponse = await fetch(`https://pokeapi.co/api/v2/evolution-chain/${idx}`);
            if (!apiResponse.ok) throw new Error('API request failed');
            const data = await apiResponse.json();

            const processEvolution = (evolutionDetails) => {
                let condition = '';
                if (evolutionDetails.min_level) condition += `Min Level: ${evolutionDetails.min_level}, `;
                if (evolutionDetails.item) condition += `Item: ${evolutionDetails.item.name}, `;
                if (evolutionDetails.min_happiness) condition += `Min Happiness: ${evolutionDetails.min_happiness}, `;
                if (evolutionDetails.time_of_day) condition += `Time of Day: ${evolutionDetails.time_of_day}, `;
                if (evolutionDetails.location) condition += `Location: ${evolutionDetails.location.name}, `;
                return condition.trimEnd(', ');
            };

            let pokemon1 = data.chain.species.name;
            let way1 = data.chain.evolves_to[0]?.evolution_details[0]?.trigger?.name || '';
            let condition1 = data.chain.evolves_to[0]?.evolution_details.map(processEvolution).join('; ') || '';
            let pokemon2 = data.chain.evolves_to[0]?.species.name || '';
            let way2 = data.chain.evolves_to[0]?.evolves_to[0]?.evolution_details[0]?.trigger?.name || '';
            let condition2 = data.chain.evolves_to[0]?.evolves_to[0]?.evolution_details.map(processEvolution).join('; ') || '';
            let pokemon3 = data.chain.evolves_to[0]?.evolves_to[0]?.species.name || '';

            console.log(`Pokemon 1: ${pokemon1}`);
            console.log(`Way 1: ${way1}`);
            console.log(`Condition 1: ${condition1}`);
            console.log(`Pokemon 2: ${pokemon2}`);
            console.log(`Way 2: ${way2}`);
            console.log(`Condition 2: ${condition2}`);
            console.log(`Pokemon 3: ${pokemon3}`);

            
            if (pokemonList.find(p => p.Name.toLowerCase() === pokemon1)) {
                const sqlStatement = `INSERT INTO pokemon_evolution (Stage1, Way12, Condition12, Stage2, Way23, Condition23, Stage3) VALUES ('${pokemon1}', '${way1}', '${condition1}', '${pokemon2}', '${way2}', '${condition2}', '${pokemon3}');`;
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
