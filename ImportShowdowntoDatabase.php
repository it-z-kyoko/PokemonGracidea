<?php
include_once('DBConnection.php');
include_once('ReadShowdownInput.php');

if (isset($_GET['input'])) {
    ReadShowdownInput($_GET['import']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showdown Importer</title>
    <link rel="stylesheet" href="Css/Forms.css">
</head>
<body>
    <form action="ImportShowdowntoDatabase.php" method="post">
        <input type="text" name="import" id="import">
        <input type="submit" value="Add to Database" name="input">
    </form>
</body>
</html>