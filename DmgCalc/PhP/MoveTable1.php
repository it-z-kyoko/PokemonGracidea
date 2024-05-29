<label for="pokemon1move1">Wähle Attacken:</label>
<table>
    <tbody>
        <tr>
            <td>
                <select id="pokemon1move1" onchange="updateMoveResults('1')">
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
                <input type="checkbox" id="1resultmovedmg1Crit" onchange="calc('pokemon1')" style="display: none;">
                <label class="checkbox-button" for="1resultmovedmg1Crit">Critical Hit</label>
            </td>
        </tr>
        <tr>
            <td>
                <select id="pokemon1move2" onchange="updateMoveResults('1')">
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
                <input type="checkbox" id="1resultmovedmg2Crit" onchange="calc('pokemon1')" style="display: none;">
                <label class="checkbox-button" for="1resultmovedmg2Crit">Critical Hit</label>
            </td>
        </tr>
        <tr>
            <td>
                <select id="pokemon1move3" onchange="updateMoveResults('1')">
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
                <input type="checkbox" id="1resultmovedmg3Crit" onchange="calc('pokemon1')" style="display: none;">
                <label class="checkbox-button" for="1resultmovedmg3Crit">Critical Hit</label>
            </td>
        </tr>
        <tr>
            <td>
                <select id="pokemon1move4" onchange="updateMoveResults('1')">
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
                <input type="checkbox" id="1resultmovedmg4Crit" onchange="calc('pokemon1')" style="display: none;">
                <label class="checkbox-button" for="1resultmovedmg4Crit">Critical Hit</label>
            </td>
        </tr>
    </tbody>
</table>

<span id="1resultmovedmg1" style="display: none;">0</span>
<span id="1resultmovedmg2" style="display: none;">0</span>
<span id="1resultmovedmg3" style="display: none;">0</span>
<span id="1resultmovedmg4" style="display: none;">0</span>