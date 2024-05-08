<div>
    <select id="pokemonSelect" onchange="updatePokemon()">
        <?php
        // Führe eine Abfrage aus, um alle Einträge aus der Tabelle pokemondata zu erhalten
        $query = "SELECT * FROM pokemondata ORDER BY Name";
        $result = $conn->query($query);

        // Überprüfe, ob die Abfrage erfolgreich war
        if ($result->numColumns() > 0) {
            // Initialisiere Variable, um den aktuellen Pokémon-Namen zu speichern
            $currentPokemon = "";

            // Durchlaufe jedes Ergebnis der Abfrage
            while ($row = $result->fetchArray()) {
                // Überprüfe, ob der Pokémon-Name sich geändert hat
                if ($currentPokemon != $row['Name']) {
                    // Schließe vorheriges optgroup-Tag, falls vorhanden
                    if ($currentPokemon != "") {
                        echo '</optgroup>';
                    }
                    // Beginne ein neues optgroup-Tag mit dem neuen Pokémon-Namen
                    echo '<optgroup label="' . $row['Name'] . '">';
                    // Setze den aktuellen Pokémon-Namen auf den neuen Wert
                    $currentPokemon = $row['Name'];
                }
                // Erstelle ein option-Element für den aktuellen Eintrag
                echo '<option value="' . $row['ImgID'] . '">' . $row['Nickname'] . '</option>';
            }
            // Schließe das letzte optgroup-Tag
            echo '</optgroup>';
        } else {
            // Ausgabe, wenn keine Daten gefunden wurden
            echo 'Keine Daten gefunden.';
        }
        ?>
    </select>
    <table>
        <tbody>
            <tr>
                <td>Type:</td>
                <td><span id="p1T1">0</span></td>
                <td><span id="p1T2">0</span></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><select name="gender1select" id="gender1select"></td>
            </tr>
            <tr>
                <td>Level:</td>
                <td><input type="number" id="level" value="50" min="1" max="100" step="1"></td>
            </tr>
        </tbody>
    </table>
    <table class="StatTable">
        <thead>
            <tr>
                <th>Stat:</th>
                <th>Base:</th>
                <th>EVs:</th>
                <th>IVs:</th>
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
                <td><input type="number" id="SpABaseStat" readonly></td>
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
                <td><input type="number" id="SpeBaseStat" readonly></td>
                <td><input type="number" id="SpeEV" min="0" max="252" step="4" oninput="initializeCalculations()" value=0></td>
                <td><input type="number" id="SpeIV" min="0" max="31" step="1" oninput="initializeCalculations()" value=0></td>
                <td><span id="resultSpe">0</span></td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td>Nature:</td>
                <td>
                    <select id="natureSelect1" onchange="updateNature('natureSelect1');">
                        <option value="Adamant">Adamant</option>
                        <option value="Bashful">Bashful</option>
                        <option value="Bold">Bold</option>
                        <option value="Brave">Brave</option>
                        <option value="Calm">Calm</option>
                        <option value="Careful">Careful</option>
                        <option value="Docile">Docile</option>
                        <option value="Gently">Gently</option>
                        <option value="Hardy">Hardy</option>
                        <option value="Hasty">Hasty</option>
                        <option value="Impish">Impish</option>
                        <option value="Jolly">Jolly</option>
                        <option value="Lax">Lax</option>
                        <option value="Lonely">Lonely</option>
                        <option value="Mild">Mild</option>
                        <option value="Modest">Modest</option>
                        <option value="Naive">Naive</option>
                        <option value="Naughty">Naughty</option>
                        <option value="Quiet">Quiet</option>
                        <option value="Quirky">Quirky</option>
                        <option value="Rash">Rash</option>
                        <option value="Relaxed">Relaxed</option>
                        <option value="Sassy">Sassy</option>
                        <option value="Serious">Serious</option>
                        <option value="Timid">Timid</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ability:</td>
                <td><select name="ability1select" id="ability1select"></select></td>
            </tr>
            <tr>
                <td>Item:</td>
                <td><select name="item1select" id="item1select"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><select name="status1select" id="status1select"></td>
            </tr>
        </tbody>
    </table>
</div>