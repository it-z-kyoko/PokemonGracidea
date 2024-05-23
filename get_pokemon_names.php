<?php
include_once("Classes/DBConnection.php");

header('Content-Type: application/json');

$conn = DBConnection::getConnection();

$query = "SELECT ID, Name FROM pokedex";
$stmt = $conn->prepare($query);
$result = $stmt->execute();

$names = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $names[] = $row;
}

if (empty($names)) {
    echo json_encode(['error' => 'No results']);
    exit;
}

echo json_encode($names);
?>
