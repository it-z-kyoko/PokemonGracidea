<?php
include_once("../Global/CalcFunctions.php");
include_once("../Classes/Pokemon.php");
include_once("../Classes/DBConnection.php");


$conn = DBConnection::getConnection();

$query = "SELECT id, name FROM pokedex";
$resultPokemon = $conn->query($query);

$query = "SELECT id, name FROM moves";
$resultmoves = $conn->query($query);
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

    <label for="pokemonSelect">Wähle ein Pokémon:</label>
    <select id="pokemonSelect" onchange="updatePokemonSelection()">
        <?php
        if ($resultPokemon->numColumns() > 0) {
            while ($row = $resultPokemon->fetchArray()) {
                echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
            }
        } else {
            echo '<option>Keine Daten gefunden</option>';
        }
        ?>
    </select>
    <input type="number" id="level" value="50" min="1" max="100" step="1">


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
                <td><input type="number" id="HPBaseStat" readonly></td>
                <td><input type="number" id="HPEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="HPIV" min="0" max="31" step="1" oninput="initializeCalculations()" value="0"></td>
                <td><span id="resultHP">0</span></td>
            </tr>
            <tr>
                <td>ATK:</td>
                <td><input type="number" id="AtkBaseStat" readonly></td>
                <td><input type="number" id="AtkEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="AtkIV" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultAtk">0</span></td>
            </tr>
            <tr>
                <td>DEF:</td>
                <td><input type="number" id="DefBaseStat" readonly></td>
                <td><input type="number" id="DefEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="DefIV" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultDef">0</span></td>
            </tr>
            <tr>
                <td>SpA:</td>
                <td><input type="number" id="SpABaseStat"  readonly></td>
                <td><input type="number" id="SpAEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpAIV" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpA">0</span></td>
            </tr>
            <tr>
                <td>SpD:</td>
                <td><input type="number" id="SpDBaseStat" readonly></td>
                <td><input type="number" id="SpDEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpDIV" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpD">0</span></td>
            </tr>
            <tr>
                <td>Spe:</td>
                <td><input type="number" id="SpeBaseStat"readonly></td>
                <td><input type="number" id="SpeEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpeIV" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpe">0</span></td>
            </tr>
        </tbody>
    </table>
    <label for="pokemonSelect2">Wähle ein Pokémon:</label>
    <select id="pokemonSelect2" onchange="updatePokemonSelection2()">
        <?php
        if ($resultPokemon->numColumns() > 0) {
            while ($row = $resultPokemon->fetchArray()) {
                echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
            }
        } else {
            echo '<option>Keine Daten gefunden</option>';
        }
        ?>
    </select>
    <input type="number" id="level2" value="50" min="0" max="100" step="1" readonly>
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
                <td><input type="number" id="HPBaseStat2" readonly></td>
                <td><input type="number" id="HPEV2" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="HPIV2" min="0" max="31" step="1" oninput="initializeCalculations()" value="0"></td>
                <td><span id="resultHP2">0</span></td>
            </tr>
            <tr>
                <td>ATK:</td>
                <td><input type="number" id="AtkBaseStat2" readonly></td>
                <td><input type="number" id="AtkEV2" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="AtkIV2" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultAtk2">0</span></td>
            </tr>
            <tr>
                <td>DEF:</td>
                <td><input type="number" id="DefBaseStat2" readonly></td>
                <td><input type="number" id="DefEV2" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="DefIV2" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultDef2">0</span></td>
            </tr>
            <tr>
                <td>SpA:</td>
                <td><input type="number" id="SpABaseStat2" readonly></td>
                <td><input type="number" id="SpAEV2" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpAIV2" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpA2">0</span></td>
            </tr>
            <tr>
                <td>SpD:</td>
                <td><input type="number" id="SpDBaseStat2" readonly></td>
                <td><input type="number" id="SpDEV2" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpDIV2" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpD2">0</span></td>
            </tr>
            <tr>
                <td>Spe:</td>
                <td><input type="number" id="SpeBaseStat2" readonly></td>
                <td><input type="number" id="SpeEV2" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpeIV2" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpe2">0</span></td>
            </tr>
        </tbody>
    </table>
    <div>
        <label for="pokemon2move1">Wähle Attacken:</label>
        <select id="pokemon2move1" onchange="moves()">
            <?php
            if ($resultmoves->numColumns() > 0) {
                while ($row = $resultmoves->fetchArray()) {
                    echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
                }
            } else {
                echo '<option>Keine Daten gefunden</option>';
            }
            ?>
        </select>
        <span id="resultmovedmg1">0</span>
        <select id="pokemon2move2" onchange="moves()">
            <?php
            if ($resultmoves->numColumns() > 0) {
                while ($row = $resultmoves->fetchArray()) {
                    echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
                }
            } else {
                echo '<option>Keine Daten gefunden</option>';
            }
            ?>
        </select>
        <span id="resultmovedmg2">0</span>
        <select id="pokemon2move3" onchange="moves()">
            <?php
            if ($resultmoves->numColumns() > 0) {
                while ($row = $resultmoves->fetchArray()) {
                    echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
                }
            } else {
                echo '<option>Keine Daten gefunden</option>';
            }
            ?>
        </select>
        <span id="resultmovedmg3">0</span>
        <select id="pokemon2move4" onchange="moves()">
            <?php
            if ($resultmoves->numColumns() > 0) {
                while ($row = $resultmoves->fetchArray()) {
                    echo '<option value="' . $row["ID"] . '">' . $row["Name"] . '</option>';
                }
            } else {
                echo '<option>Keine Daten gefunden</option>';
            }
            ?>
        </select>
        <span id="resultmovedmg4">0</span>
    </div>

    <button onclick="speichereZahl()">Speichern und an PHP senden</button>
    <script src="DmgCalc.js">
    </script>

</body>

</html>