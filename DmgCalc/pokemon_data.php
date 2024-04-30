<?php
// Fügen Sie alle erforderlichen Dateien und Klassen ein
include_once("../Classes/Pokemon.php");

// Erstellen Sie ein neues Pokémon-Objekt
$pokemon = new Pokemon(173, 'Skarmory');

// Konvertieren Sie das Pokémon-Objekt in JSON
$pokemon_json = json_encode($pokemon);

// Setzen Sie den Content-Type-Header auf JSON
header('Content-Type: application/json');

// Geben Sie das JSON zurück
echo $pokemon_json;
?>
