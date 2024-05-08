<div>
    <div>
        <select id="pokemonSelect2" onchange="updatePokemon()">
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
    </div>


    <table>
        <tbody>
            <tr>
                <td>Type:</td>
                <td><span id="p2T1">0</span></td>
                <td><span id="p2T2">0</span></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td><select name="gender2select" id="gender2select"></td>
            </tr>
            <tr>
                <td>Level:</td>
                <td> <input type="number" id="level2" value="50" min="0" max="100" step="1" readonly></td>
            </tr>
        </tbody>
    </table>

    <table>
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
    <table>
        <tbody>
            <tr>
                <td>Nature:</td>
                <td>
                    <select id="natureSelect2" onchange="updateNature('natureSelect2')">
                        <option value="Hardy">Hardy</option>
                        <option value="Lonely">Lonely</option>
                        <option value="Brave">Brave</option>
                        <option value="Adamant">Adamant</option>
                        <option value="Naughty">Naughty</option>
                        <option value="Bold">Bold</option>
                        <option value="Docile">Docile</option>
                        <option value="Relaxed">Relaxed</option>
                        <option value="Impish">Impish</option>
                        <option value="Lax">Lax</option>
                        <option value="Timid">Timid</option>
                        <option value="Hasty">Hasty</option>
                        <option value="Serious">Serious</option>
                        <option value="Jolly">Jolly</option>
                        <option value="Naive">Naive</option>
                        <option value="Modest">Modest</option>
                        <option value="Mild">Mild</option>
                        <option value="Quiet">Quiet</option>
                        <option value="Bashful">Bashful</option>
                        <option value="Rash">Rash</option>
                        <option value="Calm">Calm</option>
                        <option value="Gently">Gently</option>
                        <option value="Sassy">Sassy</option>
                        <option value="Careful">Careful</option>
                        <option value="Quirky">Quirky</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Ability:</td>
                <td>
                    <select name="ability2select" id="ability2select"></select>
            </td>
            </tr>
            <tr>
                <td>Item:</td>
                <td><select name="item2select" id="item2select"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><select name="status2select" id="status2select"></td>
            </tr>
        </tbody>
    </table>
</div>