<?php
include_once("../Classes/Pokemon.php");
include_once("../Classes/DBConnection.php");


$conn = DBConnection::getConnection();

$query = "SELECT id, name FROM pokedex";
$resultPokemon = $conn->query($query);

$query = "SELECT id, name FROM moves";
$resultmoves = $conn->query($query);
?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Dynamische Berechnung</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        label,
        input {
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="../Css/DmgCalc.css">

</head>

<body onload="bodyload()" id="body">
    <?php include("BattleGrafic.php")?>
    
    

    <?php include("MoveTable1.php")?>
   



    <?php include("MoveTable2.php")?>


    <script src="Scripts/DmgCalc.js">
    </script>
    <script src="Scripts/pkmHandling.js"></script>
    <script src="Scripts/MoveHandler.js"></script>

</body>

</html>

<style>
    /* Checkbox-Button-Stil */
    .checkbox-button {
        display: inline-block;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .checkbox-button input {
        display: none;
    }

    .checkbox-button::before {
        content: "";
        /* Pseudo-Element für den Checkbox-Stil */
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        vertical-align: middle;
        display: none;
    }

    .checkbox-button input:checked+button {
        background-color: #333;
        /* Ändern Sie die Hintergrundfarbe */
        color: #fff;
        /* Ändern Sie die Textfarbe */
    }

    /* Checkbox-Button-Stil */
    .checkbox-button {
        display: inline-block;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        transition: background-color 0.3s;
        /* Übergangseffekt für die Hintergrundfarbe */
    }

    /* Ändern Sie den Button-Stil, wenn die Checkbox aktiviert ist */
    input[type="checkbox"]:checked+.checkbox-button {
        background-color: #333;
        /* Ändern Sie die Hintergrundfarbe */
        color: #fff;
        /* Ändern Sie die Textfarbe */
    }
</style>