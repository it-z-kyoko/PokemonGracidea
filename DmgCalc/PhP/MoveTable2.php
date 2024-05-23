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
                <input type="checkbox" id="2resultmovedmg1Crit" onchange="calc('pokemon2')" style="display: none;">
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
                <input type="checkbox" id="2resultmovedmg2Crit" onchange="calc('pokemon2')" style="display: none;">
                <label class="checkbox-button" for="2resultmovedmg2Crit">Critical Hit</label>
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
                <input type="checkbox" id="2resultmovedmg3Crit" onchange="calc('pokemon2')" style="display: none;">
                <label class="checkbox-button" for="2resultmovedmg3Crit">Critical Hit</label>
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
                <input type="checkbox" id="2resultmovedmg4Crit" onchange="calc('pokemon2')" style="display: none;">
                <label class="checkbox-button" for="2resultmovedmg4Crit">Critical Hit</label>
            </td>
        </tr>
    </tbody>
</table>
<span id="2resultmovedmg2" style="display: none">0</span>
<span id="2resultmovedmg1" style="display: none">0</span>
<span id="2resultmovedmg3" style="display: none">0</span>
<span id="2resultmovedmg4" style="display: none">0</span>