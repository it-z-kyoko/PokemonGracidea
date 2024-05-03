<?php
include_once("../Classes/DBConnection.php");
include_once("../Classes/Pokemon.php");

header('Content-Type: application/json'); // Stellen Sie sicher, dass der Response-Header als JSON gesetzt ist.

if (!isset($_GET['pokemon_id']) || !is_numeric($_GET['pokemon_id'])) {
    echo json_encode(['error' => 'Invalid Pokémon ID']);
    exit;
}

$conn = DBConnection::getConnection();

$moves_id = $_GET['pokemon_id'];

$query = "SELECT * FROM pokedex WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $moves_id, SQLITE3_INTEGER); // Bindet den Integer-Parameter für die Abfrage
$resultPokemon = $stmt->execute();

$row = $resultPokemon->fetchArray(SQLITE3_ASSOC);

if ($row === false) {
    echo json_encode(['error' => 'No Pokémon found with the given ID']);
    exit;
}

$pokemon = new Pokemon($row['ID'], $row['Name']);
$pokemon->setLevel(60); // Beispiel, setzen Sie dies je nach Bedarf

// Stellen Sie sicher, dass die Klasse Pokemon eine Methode hat, die das Objekt korrekt zu einem Array oder Objekt für JSON konvertiert.
echo json_encode($pokemon->getDetails());
?>
