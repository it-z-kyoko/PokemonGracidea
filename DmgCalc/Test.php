<?php
include_once("../Global/CalcFunctions.php");
include_once("../Classes/Pokemon.php");

$pokemon = new Pokemon(173, 'Skarmory');

// Konvertiere das Pokemon-Objekt in JSON
$pokemon_json = json_encode($pokemon);

// Gib das JSON zurück
echo $pokemon_json;
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Dynamische Berechnung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        label,
        input {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <label for="HPEV">Geben Sie die Basiswerte ein:</label>
    <input type="hidden" id="AtkBaseStat" value="<?php echo $pokemon->getAtkBase();?>">
    <input type="number" id="HPEV" min="0" max="252" step="4" oninput="berechne()">
    <input type="number" id="AtkEV" min="0" max="252" step="4" oninput="berechne()">
    <!-- Weitere Input-Felder für die anderen Werte hier einfügen -->
    <button onclick="speichereZahl()">Speichern und an PHP senden</button>
    <p>Ergebnis:
        <span id="resultHP">0</span>
        <span id="resultAtk">0</span>
        <!-- Weitere Ergebnis-Elemente für die anderen Werte hier einfügen -->
    </p>
    <script>
    // Definieren Sie die pokemon-Variable im globalen Bereich
    var pokemon;

    // Rufen Sie das Pokemon-Objekt mit JavaScript ab
    fetch('pokemon_data.php')
        .then(response => response.json())
        .then(data => {
            // Weisen Sie die zurückgegebenen Daten der pokemon-Variable zu
            pokemon = data;

            // Hier können Sie das Pokemon-Objekt verwenden
            console.log(pokemon);
            // Führen Sie Ihre weiteren Operationen mit dem Pokemon-Objekt hier aus
        })
        .catch(error => console.error('Error fetching Pokemon data:', error));

    function calcStat(BaseStat, IV, EV, level) {
    let stat = Math.floor((((2 * BaseStat + IV + Math.floor(EV / 4)) * level) / 100) + 5);
    return stat;
}

    function berechne() {
        let inputFeld = document.getElementById('HPEV');
        let HpEvValue = parseInt(inputFeld.value);
        let AtkinputFeld = document.getElementById('AtkEV');
        let AtkEvValue = parseInt(AtkinputFeld.value);
        let ATKBaseField = document.getElementById('AtkBaseStat');
        let atkbase = parseInt(ATKBaseField.value);

        // Prüfen, ob die pokemon-Variable definiert ist, bevor sie verwendet wird
        if (pokemon) {
            pokemon.hpEV = parseInt(HpEvValue);
            pokemon.atkEv = parseInt(AtkEvValue);

            // Hier kann das Pokemon-Objekt verwendet werden
            console.log(pokemon);

            let result = calcStat(140, 31,254,60)

            document.getElementById('resultAtk').textContent = result;

        }
    }

    // Event-Listener für Input-Felder hinzufügen
    document.getElementById('HPEV').addEventListener('input', berechne);
    document.getElementById('AtkEV').addEventListener('input', berechne);
    // Weitere Event-Listener für die anderen Input-Felder hier hinzufügen
</script>

</body>

</html>