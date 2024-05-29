<?php
include_once("../Classes/Pokemon.php");
include_once("../Classes/DBConnection.php");


$conn = DBConnection::getConnection();

$query = "SELECT id, name FROM pokedex";
$resultPokemon = $conn->query($query);

$query = "SELECT id, name FROM moves";
$resultmoves = $conn->query($query);

$query = "SELECT * FROM HeldItems";
$resultitems = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
    <script src="Scripts/DmgCalc.js"></script>
    <script src="Scripts/pkmHandling.js"></script>
    <script src="Scripts/MoveHandler.js"></script>
    <link rel="stylesheet" href="../Css/DmgCalc.css">
</head>

<body id="body">
    <h1>Pokemon Gracidea Damage Calculator</h1>
    <div class="flex">
        <?php include("PhP/BattleGrafic.php")
        ?>
    </div>
    <div class="container">
        <div class="left">
        <?php include("PhP/Pokemon1Select.php") ?>
            <?php include("PhP/pkm1AttackStats.php") ?>
            <?php include("PhP/MoveTable1.php") ?>
        </div>
        <div class="main">
            <?php include("PhP/Checkboxes.php") ?>
        </div>
        <div class="right">
        <?php include("PhP/Pokemon2Select.php") ?>
        <?php include("PhP/pkm2AttackStats.php") ?>
            <?php include("PhP/MoveTable2.php") ?>
        </div>
    </div>
</body>

</html>