<label for="pokemon2move1">Wähle Attacken:</label>
    <table>
        <tbody>
            <tr>
                <td>
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
                </td>
                <td>
                    <span id="2resultmovedmg1">0</span>
                </td>
                <td>
                    <input type="checkbox" id="2resultmovedmg1Crit" style="display: none;">
                    <label class="checkbox-button" for="2resultmovedmg1Crit">Critical Hit</label>
                </td>
            </tr>
            <tr>
                <td>
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
                </td>
                <td>
                    <span id="2resultmovedmg2">0</span>
                </td>
                <td>
                    <input type="checkbox" id="2resultmovedmg2Crit" onchange="updateCrit()" style="display: none;">
                    <label class="checkbox-button" for="2resultmovedmg2Crit" onclick="updateCrit()">Critical Hit</label>
                </td>
            </tr>
            <tr>
                <td>
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
                </td>
                <td>
                    <span id="2resultmovedmg3">0</span>
                </td>
                <td>
                    <input type="checkbox" id="2resultmovedmg3Crit" onchange="updateCrit()" style="display: none;">
                    <label class="checkbox-button" for="2resultmovedmg3Crit" onclick="updateCrit()">Critical Hit</label>
                </td>
            </tr>
            <tr>
                <td>
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
                </td>
                <td>
                    <span id="2resultmovedmg4">0</span>
                </td>
                <td>
                    <input type="checkbox" id="2resultmovedmg4Crit" onchange="updateCrit()" style="display: none;">
                    <label class="checkbox-button" for="2resultmovedmg4Crit" onclick="updateCrit()">Critical Hit</label>
                </td>
            </tr>
        </tbody>
    </table>