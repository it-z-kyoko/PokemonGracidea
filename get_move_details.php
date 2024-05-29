<?php
include_once("Classes/DBConnection.php");
include_once("Classes/Moves.php");

header('Content-Type: application/json');

// Get the move name from the POST request body
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['name']) || empty($data['name'])) {
    echo json_encode(['error' => 'Invalid or missing move name']);
    exit;
}

$conn = DBConnection::getConnection();
$moveName = $data['name'];

$query = "SELECT * FROM pokemon_moves_temp WHERE Name = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $moveName, SQLITE3_TEXT); // Bind the text parameter for the query
$result = $stmt->execute();

$row = $result->fetchArray(SQLITE3_ASSOC);

if ($row === false) {
    echo json_encode(['error' => 'No Move found with the given name']);
    exit;
}

$move = new Move($row['ID'], $row['Name'], $row['Type'], $row['Category'], $row['Accuracy'], $row['PP'], $row['Effect'], $row['EffectProb'], $row['Target'], $row['Power']);

// Make sure the Move class has a method that correctly converts the object to an array or object for JSON
echo json_encode($move->getDetails());
?>
