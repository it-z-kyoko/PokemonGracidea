<?php
include_once("../../Classes/DBConnection.php");

header('Content-Type: application/json');

if (!isset($_GET['pokemon_id']) || !is_numeric($_GET['pokemon_id'])) {
    echo json_encode(['error' => 'Invalid Pokémon ID']);
    exit;
}

$conn = DBConnection::getConnection();

$pokemon_id = $_GET['pokemon_id'];

$query = "SELECT Gender FROM pokemon_gender WHERE pokemon = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $pokemon_id, SQLITE3_INTEGER);
$resultGender = $stmt->execute();

$genders = [];
while ($row = $resultGender->fetchArray(SQLITE3_ASSOC)) {
    $genders[] = $row['Gender'];
}

echo json_encode($genders);
?>
