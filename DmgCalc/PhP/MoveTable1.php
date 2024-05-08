<label for="pokemon1move1">Wähle Attacken:</label>
    <table>
        <tbody>
            <tr>
                <td>
                    <select id="pokemon1move1" onchange="moves()">
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
                </td>
                <td>
                    <span id="1resultmovedmg1">0</span>
                </td>
                <td>
                    <input type="checkbox" id="1resultmovedmg1Crit" style="display: none;">
                    <label class="checkbox-button" for="1resultmovedmg1Crit">Critical Hit</label>
                </td>
            </tr>
            <tr>
                <td>
                    <select id="pokemon1move2" onchange="moves()">
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
                </td>
                <td>
                    <span id="1resultmovedmg2">0</span>
                </td>
                <td>
                    <input type="checkbox" id="1resultmovedmg2Crit" onchange="updateCrit()" style="display: none;">
                    <label class="checkbox-button" for="1resultmovedmg2Crit" onclick="updateCrit()">Critical Hit</label>
                </td>
            </tr>
            <tr>
                <td>
                    <select id="pokemon1move3" onchange="moves()">
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
                </td>
                <td>
                    <span id="1resultmovedmg3">0</span>
                </td>
                <td>
                    <input type="checkbox" id="1resultmovedmg3Crit" onchange="updateCrit()" style="display: none;">
                    <label class="checkbox-button" for="1resultmovedmg3Crit" onclick="updateCrit()">Critical Hit</label>
                </td>
            </tr>
            <tr>
                <td>
                    <select id="pokemon1move4" onchange="moves()">
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
                </td>
                <td>
                    <span id="1resultmovedmg4">0</span>
                </td>
                <td>
                    <input type="checkbox" id="1resultmovedmg4Crit" onchange="updateCrit()" style="display: none;">
                    <label class="checkbox-button" for="1resultmovedmg4Crit" onclick="updateCrit()">Critical Hit</label>
                </td>
            </tr>
        </tbody>
    </table>