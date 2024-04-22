<?php
function ReadShowdownInput($string)
{
    // Verbindung zur SQLite-Datenbank herstellen
    $db = new SQLite3("Pokemon.db");

    // Text auslesen
    $string = "
    Abomasnow @ Icy Rock
    Level: 100
    Modest Nature
    Tera Type: Ground
    Ability: Snow Warning
    EVs: 168 HP / 252 SpA / 88 Spe
    IVs: 0 Atk
    Blizzard
    Earth Power
    Leaf Storm
    Aurora Veil
    ";

    // Regulären Ausdruck zur Extraktion der Daten definieren
    $namepattern = "/[@]/i";

    if (preg_match($namepattern, $string, $matches, PREG_OFFSET_CAPTURE)) {
        // Extract the text before the pattern
        $text_before_pattern = substr($string, 0, $matches[0][1]);
        echo "Text before the pattern: " . $text_before_pattern;
    } else {
        echo "Pattern not found in the input string.";
    }

    // Definiere das Muster
    $namepattern = '/@([^\n]+)/i';

    // Suche nach dem Muster
    if (preg_match($namepattern, $string, $matches)) {
        // Der gefundene Text nach dem @-Zeichen bis zum Zeilenumbruch
        $text_after_at = $matches[1];
        echo "Text nach dem @-Zeichen bis zum Zeilenumbruch: " . $text_after_at;
    } else {
        echo "Muster nicht im Eingabestring gefunden.";
    }

    $lines = explode("\n", $string);

// Initialisiere Variablen für das Ergebnis
$text_after_level = '';

// Durchsuche die Zeilen nach dem Muster
foreach ($lines as $line) {
    // Wenn das Muster gefunden wird, extrahiere den Text
    if (strpos($line, 'Level:') !== false) {
        // Finde den Text nach 'Level:' und bis zum nächsten Zeilenumbruch
        $text_after_level = trim(substr($line, strpos($line, 'Level:') + strlen('Level:')));
        break; // Beende die Schleife, sobald das Muster gefunden wurde
    }
}

// Ausgabe des Ergebnisses
if (!empty($text_after_level)) {
    echo "Text nach 'Level' bis zum nächsten Zeilenumbruch: " . $text_after_level;
} else {
    echo "Kein Text nach 'Level' gefunden.";
}
}
