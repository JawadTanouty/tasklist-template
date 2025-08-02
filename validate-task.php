<?php
require_once "bdd-crud.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {
    $database = connect_database();
    // On suppose qu'il y a un champ 'is_validated' (TINYINT ou BOOL) dans la table task
    $stmt = $database->prepare("UPDATE task SET is_validated = 1 WHERE id = ? AND user_id = ?");
    $stmt->execute([(int)$_GET["id"], $_SESSION["user_id"]]);
}
header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>validate Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>