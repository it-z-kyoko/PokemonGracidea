<div style="display: grid; align-items:center; justify-items: center;">
    <table class="table1">
        <tbody>
            <tr>
                <td>
                    <input type="checkbox" id="RH1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="RH1" onclick="">Helping Hand</label>
                </td>
                <td>
                    <input type="checkbox" id="LV1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="LV1" onclick="">Ladevorgang</label>
                </td>
                <td>
                    <input type="checkbox" id="Ref1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="Ref1" onclick="">Reflect</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="Li1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="Li1" onclick="">Light Screen</label>
                </td>
                <td>
                    <input type="checkbox" id="FF1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="FF1" onclick="">Flash Fire</label>
                </td>
                <td>
                    <input type="checkbox" id="PM1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="PM1" onclick="">Plus/Minus</label>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="checkbox" id="SS1" onchange="" style="display: none;">
                    <label class="checkbox-button" for="SS1" onclick="">Slow Start</label>
                </td>
            </tr>
        </tbody>
    </table>


    <select id="pokemonSelect" onchange="updatePokemon()">
        <?php
        $query = "SELECT * FROM pokemondata ORDER BY Name";
        $result = $conn->query($query);

        if ($result->numColumns() > 0) {
            $currentPokemon = "";

            while ($row = $result->fetchArray()) {
                if ($currentPokemon != $row['Name']) {
                    if ($currentPokemon != "") {
                        echo '</optgroup>';
                    }
                    echo '<optgroup label="' . $row['Name'] . '">';
                    $currentPokemon = $row['Name'];
                }
                echo '<option value="' . $row['ImgID'] . '">' . $row['Nickname'] . '</option>';
            }
            echo '</optgroup>';
        } else {
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
            <tr>
                <td>Current HP:</td>
                <td><input type="number" name="CurrHP1" id="CurrHP1" min="1" max="1" step="1" onchange="healthupdate()"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div id="1health-bar-inner" style="color:white;"></div>
                </td>
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
                <th>Stat:</th>
                <th>Boost:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>HP:</td>
                <td><input type="number" id="HPBaseStat" readonly></td>
                <td><input type="number" id="HPEV" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="HPIV" min="0" max="31" step="1" value="0"></td>
                <td><span id="resultHP">0</span></td>
            </tr>
            <tr>
                <td>ATK:</td>
                <td><input type="number" id="AtkBaseStat" readonly></td>
                <td><input type="number" id="AtkEV" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="AtkIV" min="0" max="31" step="1" value=0></td>
                <td><span id="resultAtk">0</span></td>
                <td>
                    <select name="Atkboost1" id="Atkboost1" style="background: none; width: 40px;padding:0px;text-align:center" onchange="updateMoveResults('1')">
                        <option value="0">0</option>
                        <option value="+1">+1</option>
                        <option value="+2">+2</option>
                        <option value="+3">+3</option>
                        <option value="+4">+4</option>
                        <option value="+5">+5</option>
                        <option value="+6">+6</option>
                        <option value="-1">-1</option>
                        <option value="-2">-2</option>
                        <option value="-3">-3</option>
                        <option value="-4">-4</option>
                        <option value="-5">-5</option>
                        <option value="-6">-6</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>DEF:</td>
                <td><input type="number" id="DefBaseStat" readonly></td>
                <td><input type="number" id="DefEV" min="0" max="252" step="4" value="0"></td>
                <td><input type="number" id="DefIV" min="0" max="31" step="1" value="0"></td>
                <td><span id="resultDef">0</span></td>
                <td>
                    <select name="Defboost1" id="Defboost1" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('1')">
                        <option value="0">0</option>
                        <option value="+1">+1</option>
                        <option value="+2">+2</option>
                        <option value="+3">+3</option>
                        <option value="+4">+4</option>
                        <option value="+5">+5</option>
                        <option value="+6">+6</option>
                        <option value="-1">-1</option>
                        <option value="-2">-2</option>
                        <option value="-3">-3</option>
                        <option value="-4">-4</option>
                        <option value="-5">-5</option>
                        <option value="-6">-6</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>SpA:</td>
                <td><input type="number" id="SpABaseStat" readonly></td>
                <td><input type="number" id="SpAEV" min="0" max="252" step="4" value="0"></td>
                <td><input type="number" id="SpAIV" min="0" max="31" step="1" value="0"></td>
                <td><span id="resultSpA">0</span></td>
                <td>
                    <select name="SpAboost1" id="SpAboost1" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('1')">
                        <option value="0">0</option>
                        <option value="+1">+1</option>
                        <option value="+2">+2</option>
                        <option value="+3">+3</option>
                        <option value="+4">+4</option>
                        <option value="+5">+5</option>
                        <option value="+6">+6</option>
                        <option value="-1">-1</option>
                        <option value="-2">-2</option>
                        <option value="-3">-3</option>
                        <option value="-4">-4</option>
                        <option value="-5">-5</option>
                        <option value="-6">-6</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>SpD:</td>
                <td><input type="number" id="SpDBaseStat" readonly></td>
                <td><input type="number" id="SpDEV" min="0" max="252" step="4" value="0"></td>
                <td><input type="number" id="SpDIV" min="0" max="31" step="1" value="0"></td>
                <td><span id="resultSpD">0</span></td>
                <td>
                    <select name="SpDboost1" id="SpDboost1" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('1')">
                        <option value="0">0</option>
                        <option value="+1">+1</option>
                        <option value="+2">+2</option>
                        <option value="+3">+3</option>
                        <option value="+4">+4</option>
                        <option value="+5">+5</option>
                        <option value="+6">+6</option>
                        <option value="-1">-1</option>
                        <option value="-2">-2</option>
                        <option value="-3">-3</option>
                        <option value="-4">-4</option>
                        <option value="-5">-5</option>
                        <option value="-6">-6</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Spe:</td>
                <td><input type="number" id="SpeBaseStat" readonly></td>
                <td><input type="number" id="SpeEV" min="0" max="252" step="4" value="0"></td>
                <td><input type="number" id="SpeIV" min="0" max="31" step="1" value="0"></td>
                <td><span id="resultSpe">0</span></td>
                <td>
                    <select name="Speboost1" id="Speboost1" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('1')">
                        <option value="0">0</option>
                        <option value="+1">+1</option>
                        <option value="+2">+2</option>
                        <option value="+3">+3</option>
                        <option value="+4">+4</option>
                        <option value="+5">+5</option>
                        <option value="+6">+6</option>
                        <option value="-1">-1</option>
                        <option value="-2">-2</option>
                        <option value="-3">-3</option>
                        <option value="-4">-4</option>
                        <option value="-5">-5</option>
                        <option value="-6">-6</option>
                    </select>
                </td>
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
                <td><select name="ability1select" id="ability1select" onchange="updateMoveResults('1')"></select></td>
            </tr>
            <td>Item:</td>
            <td>
                <select name="item1select" id="item1select" onchange="updateMoveResults('1')">
                    <option value="none">No Item</option>
                    <?php
                    while ($row = $resultitems->fetchArray(SQLITE3_ASSOC)) {
                        echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
                    }
                    ?>
                </select>
            </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><select name="status1select" id="status1select" onchange="updateMoveResults('1')">
                        <option value="Healthy">Healthy</option>
                        <option value="Burn">Burned</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
</div>