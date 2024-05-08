<?php
include_once("../../Classes/DBConnection.php");
include_once("../../Classes/Moves.php");

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['error' => 'Invalid Moves ID']);
    exit;
}

$conn = DBConnection::getConnection();

$moves_id = $_GET['id'];

$query = "SELECT * FROM moves WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $moves_id, SQLITE3_INTEGER); // Bindet den Integer-Parameter für die Abfrage
$resultPokemon = $stmt->execute();

$row = $resultPokemon->fetchArray(SQLITE3_ASSOC);

if ($row === false) {
    echo json_encode(['error' => 'No Move found with the given ID']);
    exit;
}

$moves = new Move($row['ID'], $row['Name'],$row['Type'],$row['Category'],$row['Accuracy'],$row['PP']
,$row['Effect'],$row['EffectProb'],$row['Target'],$row['Power']);

// Stellen Sie sicher, dass die Klasse Pokemon eine Methode hat, die das Objekt korrekt zu einem Array oder Objekt für JSON konvertiert.
echo json_encode($moves->getDetails());
?>