<?php
// Einbinden der Klassen Pokemon und DBConnection
include_once("../Classes/Pokemon.php");
include_once("../Classes/DBConnection.php");

// Verbindung zur Datenbank herstellen
$conn = DBConnection::getConnection();

// Überprüfen der Verbindung
if (!$conn) {
    die("Verbindung zur Datenbank fehlgeschlagen.");
}

// SQL-Abfrage, um Pokemon mit Nickname beginnend mit "Gym" auszuwählen
$sql = "SELECT * FROM pokemon_data WHERE Nickname LIKE 'Gym%'";

$result = $conn->query($sql);

// Überprüfen, ob Ergebnisse vorhanden sind
if ($result->numColumns() > 0) {
    // Formatieren der Ergebnisse im Format für den Showdown Battle Calculator
    while($row = $result->fetchArray()) {
        echo $row["Name"] . " @ " . $row["Item"] . "<br>";
        echo "Ability: " . $row["Ability"] . "<br>";
        echo "EVs: " . $row["HPEV"] . "/" . $row["ATKEV"] . "/" . $row["DEFEV"] . "/" . $row["SPATKEV"] . "/" . $row["SPDEFEV"] . "/" . $row["SPEEDEV"] . "<br>";
        echo $row["Nature"] . " Nature<br>";
        echo "- " . $row["Move1"] . "<br>";
        echo "- " . $row["Move2"] . "<br>";
        echo "- " . $row["Move3"] . "<br>";
        echo "- " . $row["Move4"] . "<br><br>";
    }
} else {
    echo "Keine Pokemon gefunden.";
}

// Verbindung zur Datenbank schließen
$conn->close();
?>
 