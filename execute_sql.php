<?php
include_once("Classes/DBConnection.php");

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$sql = $data['sql'];

try {
    $conn = DBConnection::getConnection();
    $conn->exec($sql);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
