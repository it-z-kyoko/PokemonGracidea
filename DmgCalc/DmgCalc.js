function speichereZahl() {
    let inputZahl = document.getElementById('inputNumber').value;

    // Speichere den Wert in einem Attribut des JavaScript-Objekts
    pokemon.inputZahl = inputZahl;

    // Sende den Wert an PHP
    window.location.href = 'Test.php?wert=' + inputZahl;
}

function berechne() {
    let inputFeld = document.getElementById('HPEV');
    let HpEvValue = parseInt(inputFeld.value);
    let AtkinputFeld = document.getElementById('AtkEV');
    let AtkEvValue = parseInt(AtkinputFeld.value);

    // Prüfe, ob der Wert ein Vielfaches von 4 ist. Wenn nicht, runde ihn auf das nächste niedrigere Vielfache von 4 ab.
    if (AtkEvValue % 4 !== 0) {
        AtkEvValue = AtkEvValue - (AtkEvValue % 4);
        AtkinputFeld.value = AtkEvValue; // Setze den korrigierten Wert zurück in das Eingabefeld
    }



    pokemon.hpEV = HpEvValue;
    pokemon.atkEv = AtkEvValue;
    let ergebnis = pokemon.CalcStat(pokemon.AtkBase,pokemon.AtkIv,AtkEvValue);
    document.getElementById('resultAtk').textContent = ergebnis;
}

document.getElementById('inputNumber').addEventListener('change', berechne);