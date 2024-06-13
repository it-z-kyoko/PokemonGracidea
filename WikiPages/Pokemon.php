<?php
include_once("../Classes/DBConnection.php");

$conn = DBConnection::getConnection();

$id = $_GET["id"];

$sql = "SELECT * FROM WikiData WHERE Pokemon_ID = :id";
$stmtPokemonMoves = $conn->prepare($sql);
$stmtPokemonMoves->bindValue(':id',$id);
$result = $stmtPokemonMoves->execute();
if ($result->numColumns() > 0) {
    $row = $result->fetchArray();
} else {
    echo "No Pokemon found in WikiData";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["Name"]?></title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<div class="split-container">
    <div class="Infos">
        <h2>Pokemon Name</h2>
        <p><?php echo $row["Entry"]?></p>
        <h2>Looks</h2>
        <p><?php echo $row["Looks"]?></p>
        <h2>Behavior and Habitat</h2>
        <p><?php echo $row["Behavior"]?></p>
        <h2>Evolve-Line</h2>
        <h2>Where to Find it</h2>
        <p><?php echo $row["Wheretofind"]?></p>
        <h2>Trainer</h2>
        <h2>Attacks</h2>
        <h2>Story Relevance</h2>
    </div>
    <div class="table">
        <table>
            <tbody>
                <th>Pokemon Name</th>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
    <style>
        body {
            background: #f0f0f0;
        }
        .split-container {
            display: grid;
            grid-template-columns: 50% 50%;
            margin: 20px;
            padding: 20px;
            border: 2px solid #000;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            justify-items: center;
        }
        .Infos {
            padding: 20px;
            justify-self:left;
        }
        .Infos h2 {
            color: #3b4cca;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-family: 'Press Start 2P', cursive;
        }
        .Infos p {
            color: #555;
            font-size: 14px;
            line-height: 1.5;
        }
        .table {
            padding: 20px;
            background: #3b4cca;
            color: #fff;
            border-radius: 18px;
            width: 80%;
        }
        .table table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #fff;
            padding: 10px;
            text-align: left;
        }
        .table th {
            color: #000;
            font-family: 'Press Start 2P', cursive;
        }
        .table td {
            background: #fff;
            color: #000;
        }
    </style>