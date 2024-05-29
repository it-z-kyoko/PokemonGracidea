<?php
include_once("../../Classes/DBConnection.php");
include_once("../../Classes/Moves.php");

header('Content-Type: application/json');

if (!isset($_GET['pokemon_id']) || !is_numeric($_GET['pokemon_id'])) {
    echo json_encode(['error' => 'Invalid Pokemon ID']);
    exit;
}

$conn = DBConnection::getConnection();

$pokemon_id = $_GET['pokemon_id'];

// Prepare the query to fetch related Pokemon moves
$queryPokemonMoves = "SELECT * FROM PokemonMoves WHERE Pokemon = :id";
$stmtPokemonMoves = $conn->prepare($queryPokemonMoves);
$stmtPokemonMoves->bindValue(':id', $pokemon_id, SQLITE3_INTEGER); // Bind the integer parameter for the query
$resultPokemonMoves = $stmtPokemonMoves->execute();

$pokemonMoves = [];
while ($rowPokemonMove = $resultPokemonMoves->fetchArray(SQLITE3_ASSOC)) {
    $move_id = $rowPokemonMove['Move'];

    // Fetch move details for each move
    $queryMove = "SELECT * FROM moves WHERE ID = ?";
    $stmtMove = $conn->prepare($queryMove);
    $stmtMove->bindValue(1, $move_id, SQLITE3_INTEGER); // Bind the integer parameter for the query
    $resultMove = $stmtMove->execute();
    $rowMove = $resultMove->fetchArray(SQLITE3_ASSOC);

    if ($rowMove !== false) {
        $move = new Move($rowMove['ID'], $rowMove['Name'], $rowMove['Type'], $rowMove['Category'], $rowMove['Accuracy'], $rowMove['PP'], $rowMove['Effect'], $rowMove['EffectProb'], $rowMove['Target'], $rowMove['Power']);
        $pokemonMoves[] = $move->getDetails();
    }
}

// Return the Pokemon moves as JSON
echo json_encode($pokemonMoves);
?>
