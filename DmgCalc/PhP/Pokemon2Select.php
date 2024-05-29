<div style="display: grid; align-items:center; justify-items: center;">
    <table class="table2">
        <tbody>
            <tr>
                <td>
                    <input type="checkbox" id="RH2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="RH2" onclick="">Helping Hand</label>
                </td>
                <td>
                    <input type="checkbox" id="LV2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="LV2" onclick="">Ladevorgang</label>
                </td>
                <td>
                    <input type="checkbox" id="Ref2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="Ref2" onclick="">Reflect</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="Li2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="Li2" onclick="">Light Screen</label>
                </td>
                <td>
                    <input type="checkbox" id="FF2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="FF2" onclick="">Flash Fire</label>
                </td>
                <td>
                    <input type="checkbox" id="PM2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="PM2" onclick="">Plus/Minus</label>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="checkbox" id="SS2" onchange="" style="display: none;">
                    <label class="checkbox-button" for="SS2" onclick="">Slow Start</label>
                </td>
            </tr>
        </tbody>
    </table>

    <div>
        <select id="pokemonSelect2" onchange="updatePokemon()">
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
                <td><select name="gender2select" id="gender2select">
                    </select>
                </td>
            </tr>
            <tr>
                <td>Level:</td>
                <td> <input type="number" id="level2" value="50" min="0" max="100" step="1" readonly></td>
            </tr>
            <tr>
                <td>Current HP:</td>
                <td><input type="number" name="CurrHP2" id="CurrHP2" min="1" max="1" step="1" onchange="healthupdate()"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div id="2health-bar-inner" style="color:white;"></div>
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
                <td><input type="number" id="HPBaseStat2" readonly></td>
                <td><input type="number" id="HPEV2" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="HPIV2" min="0" max="31" step="1" value="0"></td>
                <td><span id="resultHP2">0</span></td>
            </tr>
            <tr>
                <td>ATK:</td>
                <td><input type="number" id="AtkBaseStat2" readonly></td>
                <td><input type="number" id="AtkEV2" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="AtkIV2" min="0" max="31" step="1" value=0></td>
                <td><span id="resultAtk2">0</span></td>
                <td>
                    <select name="Atkboost2" id="Atkboost2" style="background: none; width: 40px;padding:0px;text-align:center" onchange="updateMoveResults('2')">
                        <option value="+1">+1</option>
                        <option value="+2">+2</option>
                        <option value="+3">+3</option>
                        <option value="+4">+4</option>
                        <option value="+5">+5</option>
                        <option value="+6">+6</option>
                        <option value="0" selected="selected">0</option>
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
                <td><input type="number" id="DefBaseStat2" readonly></td>
                <td><input type="number" id="DefEV2" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="DefIV2" min="0" max="31" step="1" value=0></td>
                <td><span id="resultDef2">0</span></td>
                <td>
                    <select name="Defboost2" id="Defboost2" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('2')">
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
                <td><input type="number" id="SpABaseStat2" readonly></td>
                <td><input type="number" id="SpAEV2" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="SpAIV2" min="0" max="31" step="1" value=0></td>
                <td><span id="resultSpA2">0</span></td>
                <td>
                    <select name="SpAboost2" id="SpAboost2" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('2')">
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
                <td><input type="number" id="SpDBaseStat2" readonly></td>
                <td><input type="number" id="SpDEV2" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="SpDIV2" min="0" max="31" step="1" value=0></td>
                <td><span id="resultSpD2">0</span></td>
                <td>
                    <select name="SpDboost2" id="SpDboost2" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('2')">
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
                <td><input type="number" id="SpeBaseStat2" readonly></td>
                <td><input type="number" id="SpeEV2" min="0" max="252" step="4" value=0></td>
                <td><input type="number" id="SpeIV2" min="0" max="31" step="1" value=0></td>
                <td><span id="resultSpe2">0</span></td>
                <td>
                    <select name="Speboost2" id="Speboost2" style="background: none; width: 40px; padding: 0px;text-align:center" onchange="updateMoveResults('2')">
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
                    <select name="ability2select" id="ability2select" onchange="updateMoveResults('2')">

                    </select>
                </td>
            </tr>
            <tr>
                <td>Item:</td>
                <td><select name="item2select" id="item2select" onchange="updateMoveResults('2')">
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
                <td><select name="status2select" id="status2select" onchange="updateMoveResults('2')">
                        <option value="Healthy">Healthy</option>
                        <option value="Burn">Burned</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
</div>