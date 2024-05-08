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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <script src="Scripts/DmgCalc.js"></script>
    <script src="Scripts/pkmHandling.js"></script>
    <script src="Scripts/MoveHandler.js"></script>
</head>

<body onload="bodyload()" id="body">
    <h1>Pokemon Gracidea Damage Calculator</h1>
    <div class="flex">
                <?php include("PhP/BattleGrafic.php")
                ?>
            </div>
    <div class="container">
        <div class="header">header</div>
        <div class="a-A6XXM-0">
            <?php include("PhP/Pokemon1Select.php")?>
        </div>
        <div class="BattlePicture">
        </div>
        <div class="a-A6XXM-2">
        <?php include("PhP/Pokemon2Select.php")?>
        </div>
        <div class="left">
            <?php include("PhP/MoveTable1.php")?>
        </div>
        <div class="main">main</div>
        <div class="right">
        <?php include("PhP/MoveTable2.php")?>
        </div>
        <div class="footer">footer</div>
    </div>
</body>

</html>

<style>
    .BattlePicture {
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
    }

    .flex {
        display: flex
    }

    #body {
        display: flex;
        margin: 0;
        flex-direction: column;
        align-content: center;
        align-items: center;
    }

    /* Allgemeine Stile */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Header-Stile */
    header {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }

    header h1 {
        margin: 0;
        font-size: 36px;
    }

    /* Navigations-Stile */
    nav {
        text-align: center;
        margin-top: 20px;
    }

    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: #fff;
        font-size: 18px;
    }

    /* Hauptinhalt-Stile */
    .main-content {
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 10px;
    }

    /* Footer-Stile */
    footer {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }

    footer p {
        margin: 0;
    }

    /* Link-Stile */
    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .container {
        display: grid;
        width: 80%;
        height: 100%;
        grid-template-areas: "header header header"
            "a-A6XXM-0 a-A6XXM-1 a-A6XXM-2"
            "left main right"
            "footer footer footer";
        grid-template-columns: 35% 30% 35%;

    }

    .container>div {
        border: 1px dashed #888;
    }

    .header {
        grid-area: header;
    }

    .a-A6XXM-0 {
        grid-area: a-A6XXM-0;
    }

    .a-A6XXM-1 {
        grid-area: a-A6XXM-1;
    }

    .a-A6XXM-2 {
        grid-area: a-A6XXM-2;
    }

    .left {
        grid-area: left;
    }

    .main {
        grid-area: main;
    }

    .right {
        grid-area: right;
    }

    .footer {
        grid-area: footer;
    }

    td {
        width:50px
    }

    input {
        width: 50px;
    }

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