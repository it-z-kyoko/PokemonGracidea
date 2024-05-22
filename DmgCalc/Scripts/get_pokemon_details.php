<?php
include_once("../../Classes/DBConnection.php");
include_once("../../Classes/Pokemon.php");

header('Content-Type: application/json');

if (!isset($_GET['pokemon_id']) || !is_numeric($_GET['pokemon_id'])) {
    echo json_encode(['error' => 'Invalid Pokémon ID']);
    exit;
}

$conn = DBConnection::getConnection();

$moves_id = $_GET['pokemon_id'];
$nickname = $_GET['nickname'];

$query = "SELECT * FROM pokemondata WHERE ImgID = ? AND Nickname = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $moves_id);
$stmt->bindValue(2, $nickname);
$resultPokemon = $stmt->execute();

$row = $resultPokemon->fetchArray(SQLITE3_ASSOC);

if ($row === false) {
    echo json_encode(['error' => 'No Pokémon found with the given ID']);
    exit;
}

$pokemon = new Pokemon($row['ImgID'], $row['Name']);
$pokemon->setLevel($row["Level"]);
$pokemon->setHPEV($row["HPEV"]);
$pokemon->setHPIV($row["HPIV"]);
$pokemon->setAtkEV($row["ATKEV"]);
$pokemon->setAtkIV($row["ATKIV"]);
$pokemon->setDefEV($row["DEFEV"]);
$pokemon->setDefIV($row["DEFIV"]);
$pokemon->setSpAtkEV($row["SPATKEV"]);
$pokemon->setSpAtkIV($row["SPATKIV"]);
$pokemon->setSpDefEV($row["SPDEFEV"]);
$pokemon->setSpDefIV($row["SPDEFIV"]);
$pokemon->setSpeedEV($row["SPEEDEV"]);
$pokemon->setSpeedIV($row["SPEEDIV"]);
$pokemon->setNature($row["Nature"]);
$pokemon->NatureAffect();

// Stellen Sie sicher, dass die Klasse Pokemon eine Methode hat, die das Objekt korrekt zu einem Array oder Objekt für JSON konvertiert.
echo json_encode($pokemon->getDetails());
