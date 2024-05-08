<?php
include_once("../../Classes/DBConnection.php");

header('Content-Type: application/json');

if (!isset($_GET['pokemon_id']) || !is_numeric($_GET['pokemon_id'])) {
    echo json_encode(['error' => 'Invalid Pokémon ID']);
    exit;
}

$conn = DBConnection::getConnection();

$moves_id = $_GET['pokemon_id'];
$nickname = $_GET['nickname'];

$query = "SELECT Ability1, Ability2, Ability3 FROM pokemondata WHERE ImgID = ? AND Nickname = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $moves_id);
$stmt->bindValue(2, $nickname);
$resultPokemon = $stmt->execute();

$row = $resultPokemon->fetchArray(SQLITE3_ASSOC);

if ($row === false) {
    echo json_encode(['error' => 'No Move found with the given ID']);
    exit;
}

// Die Daten in das gewünschte JSON-Format umwandeln
$response = [
    'Ability1' => $row['Ability1'],
    'Ability2' => $row['Ability2'],
    'Ability3' => $row['Ability3']
];

echo json_encode($response);
?>
