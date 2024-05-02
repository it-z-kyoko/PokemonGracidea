<?php
include_once("../Global/CalcFunctions.php");
include_once("../Classes/Pokemon.php");

$pokemon = new Pokemon(173, 'Skarmory');
$pokemon->setLevel(60);

// Konvertiere das Pokemon-Objekt in JSON
$pokemon_json = json_encode($pokemon);
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
    <link rel="stylesheet" href="../Css/DmgCalc.css">

</head>

<body onload="bodyload()" id="body">


    <label for="HPEV">Geben Sie die Basiswerte ein:</label>
    <input type="hidden" id="level" value="<?php echo $pokemon->getLevel(); ?>">
    <table class="StatTable">
        <thead>
            <tr>
                <th>Stat:</th>
                <th>Basestat:</th>
                <th>EV-Value</th>
                <th>IV-Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>HP:</td>
                <td><input type="number" id="HPBaseStat" value="<?php echo $pokemon->getHPBase(); ?>" readonly></td>
                <td><input type="number" id="HPEV" min="0" max="252" step="4" oninput="CalcHPStat()" value=0></td>
                <td><input type="number" id="HPIV" min="0" max="31" step="1" oninput="CalcHPStat()" value="0"></td>
                <td><span id="resultHP">0</span></td>
            </tr>
            <tr>
                <td>ATK:</td>
                <td><input type="number" id="AtkBaseStat" value="<?php echo $pokemon->getAtkBase(); ?>" readonly></td>
                <td><input type="number" id="AtkEV" min="0" max="252" step="4" oninput="CalcAtkStat()" value=0></td>
                <td><input type="number" id="AtkIV" min="0" max="31" step="1" oninput="CalcAtkStat()" value=0></td>
                <td><span id="resultAtk">0</span></td>
            </tr>
            <tr>
                <td>DEF:</td>
                <td><input type="number" id="DefBaseStat" value="<?php echo $pokemon->getDefBase(); ?>" readonly></td>
                <td><input type="number" id="DefEV" min="0" max="252" step="4" oninput="CalcDefStat()" value=0></td>
                <td><input type="number" id="DefIV" min="0" max="31" step="1" oninput="CalcDefStat()" value=0></td>
                <td><span id="resultDef">0</span></td>
            </tr>
            <tr>
                <td>SpA:</td>
                <td><input type="number" id="SpABaseStat" value="<?php echo $pokemon->getSpABase(); ?>" readonly></td>
                <td><input type="number" id="SpAEV" min="0" max="252" step="4" oninput="CalcSpAStat()" value=0></td>
                <td><input type="number" id="SpAIV" min="0" max="31" step="1" oninput="CalcSpAStat()" value=0></td>
                <td><span id="resultSpA">0</span></td>
            </tr>
            <tr>
                <td>SpD:</td>
                <td><input type="number" id="SpDBaseStat" value="<?php echo $pokemon->getSpDBase(); ?>" readonly></td>
                <td><input type="number" id="SpDEV" min="0" max="252" step="4" oninput="CalcSpDStat()" value=0></td>
                <td><input type="number" id="SpDIV" min="0" max="31" step="1" oninput="CalcSpDStat()" value=0></td>
                <td><span id="resultSpD">0</span></td>
            </tr>
            <tr>
                <td>Spe:</td>
                <td><input type="number" id="SpeBaseStat" value="<?php echo $pokemon->getSpeBase(); ?>" readonly></td>
                <td><input type="number" id="SpeEV" min="0" max="252" step="4" oninput="CalcSpeStat()" value=0></td>
                <td><input type="number" id="SpeIV" min="0" max="31" step="1" oninput="CalcSpeStat()" value=0></td>
                <td><span id="resultSpe">0</span></td>
            </tr>

        </tbody>
    </table>

    <button onclick="speichereZahl()">Speichern und an PHP senden</button>
    <script src="DmgCalc.js">
    </script>

</body>

</html>
